<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GlobalException;
use App\Http\Controllers\Controller;
use App\Mail\EteeapMailer;
use App\Models\Otp;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\confirm;

class UserController extends Controller
{
    public function register(Request $request) {
        DB::beginTransaction();
        try {
            $validated = validatorHelper()->validate('accounts_save', $request);
            
            if ($validated['status'] === "error") {
                return $validated;
            }

            $user_data = $validated['validated'];

            if ($user_data['password'] !== $user_data['confirm_password']) {
                return [
                    'status' => 'error',
                    'message' => 'Password did not match!',
                ];
            }

            $email = $user_data['email'];
            $firstname = $user_data['firstname'];
            $otp = globalHelper()->genOtp();

            User::create($user_data);
            Otp::updateOrCreate( ['identity' => $email], ['otp' => $otp] );

            $mail = globalHelper()->sendEmail('registration', $email, [
                'otp' => $otp,
                'fname' => $firstname,
                'link' => url("/verify-email?email=").base64_encode($email),
            ]);
            
            DB::commit();

            return [
                'status' => 'ok',
            ];
            
        } catch(GlobalException $ge) {
            DB::rollBack();
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        } catch(QueryException $qe) {
            DB::rollBack();
            Log::channel('info')->info("Exception : ".$qe->getMessage());
            $errorCode = $qe->errorInfo[1];
            if($errorCode == 1062){
                return [
                    'status' => 'error',
                    'message' => 'Email already exists!',
                ];
            }

            throw new GlobalException();
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::channel('info')->info("Exception : ".$e->getMessage());
            throw new GlobalException();
        }
    }

    public function verifyEmail(Request $request) {
        
        $validated = validatorHelper()->validate('verify_email', $request);
        
        if ($validated['status'] === "error") {
            return $validated;
        }
        
        DB::beginTransaction();
        try {

            $otp = globalHelper()->confirmOtp(
                $validated['validated']['email'],
                strtoupper($validated['validated']['otp']),
            );

            if ($otp['status'] == 'ok') {
                User::where('email', $validated['validated']['email'])->update(['status' => 1]);
                Otp::where('identity', $validated['validated']['email'])->update(['is_verified' => 1]);
            
                DB::commit();
                
                return [
                    'status' => 'done'
                ];
            }

            DB::rollBack();
            return $otp;

            
        } catch(GlobalException $ge) {
            DB::rollBack();
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        }
    }

    public function resendOtp(Request $request) {
        
        $validated = validatorHelper()->validate('resend_otp', $request);
        
        if ($validated['status'] === "error") {
            return $validated;
        }

        try {
            $user_data = $validated['validated'];
            $email = $user_data['email'];
            $info = User::where('email', $email)->get();
            

            if ($info) {
                $info_data_arr = $info->toArray()[0];

                $firstname = $info_data_arr['firstname'];
                
                $otp = globalHelper()->genOtp();
                
                Otp::updateOrCreate( ['identity' => $email ], ['otp' => $otp] );

                $mail = globalHelper()->sendEmail('resend-otp', $email, [
                    'otp' => $otp,
                    'fname' => $firstname,
                ]);

                return [
                    'status' => 'ok',
                ];
            }
            
            return [
                'status' => 'error',
            ];
            
            
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        }

    }
    
    public function login(Request $request) {
        
        try {
            $key = 'email';
            $admin_data = $request->validate([
                'email' => 'required|string',
                'password' => 'required',
            ]);
    
            if (! Auth::attempt($admin_data)) {
                $key = 'username';
                // throw new GlobalException('Invalid Username or Password', 400);
                $admin_data = [
                    'email' => $admin_data['email'],
                    'password' => $admin_data['password'],
                ];

                if (! Auth::attempt($admin_data)) {
                    throw new GlobalException('Invalid Username or Password', 400);
                }
            }

            $user = User::where($key, $admin_data[$key])->first();

            return response()->json([
                'status' => 'ok',
                'info' => [
                    'user_id' => Auth::id(),
                    'access_token' => $user->createToken('api_token')->plainTextToken,
                    'token_type' => 'Bearer',
                ],
            ]);

        } catch(GlobalException $ge) {
            Log::channel('info')->info($ge->getMessage());
            throw new GlobalException('Invalids Username or Password', 400);
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage(), $e->getTrace());
            throw new GlobalException();
        }
    }

    public function logout(Request $request) {

        try {
            $request->user()->tokens()->delete();
            // Auth::user()->currentAccessToken()->delete();
            
            return response()->json([
                'status' => 'ok',
                'info' => [],
            ]);
        } catch(GlobalException $ge) {
            Log::channel('info')->info($ge->getMessage());
            throw new GlobalException('Cannot continue, please call system administrator', 400);
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage());
            throw new GlobalException('Cannot continue, please call system administrator', 400);
        }
    }

    public function getNonAdminUser(Request $request) {
        try {
            $admin_key = array_search('Admin', config('custom.user_type'));
            $users = User::where('user_type', '!=', $admin_key)
            ->with('company')
            ->orderBy('firstname', 'asc')->paginate(1);
            
            return [
                'status' => 'ok',
                'list' => $users
            ];
                
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        }
    }

    // Accounts Registration
    

    public function updateNonAdminUser($id, Request $request) {
        try {

            $validated = validatorHelper()->validate('accounts_update', $request);
            if ($validated['status'] === "error") {
                return $validated;
            }

            $username = strtolower($validated['validated']['code'].".".$validated['validated']['emp_id']);
            $password = globalHelper()->genDefaultPassword();
            $status = 1;

            $user_data = array_merge($validated['validated'], 
                [
                    'company_code' => $validated['validated']['code'],
                    'username' => $username, 
                    'password' => $password, 
                    'status' => $status,
                ]
            );

            unset($user_data['code']);

            $user = User::find($id);
            if ($user) {
                $user->update($user_data);

                return [
                    'status' => 'ok',
                    'info' => $user
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => globalHelper()->ajaxErrorResponse('User not found!')
                ];
            }
            
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        } catch(QueryException $qe) {
            
            Log::channel('info')->info("Exception : ".$qe->getMessage());
            $errorCode = $qe->errorInfo[1];
            if($errorCode == 1062){
                return [
                    'status' => 'error',
                    'message' => 'Duplicate entry for user with employee: '. $validated['validated']['emp_id'] . ' and email : '.$validated['validated']['email']
                ];
            }

            throw new GlobalException();
            
        } catch (Exception $e) {
            Log::channel('info')->info("Exception : ".$e->getMessage());
            throw new GlobalException();
        }
    }

    public function resetNonAdminUser($id, Request $request) {
        try {

            $password = globalHelper()->genDefaultPassword();
            $user = User::find($id);
            if ($user) {
                $user->update(['password' => $password]);

                return [
                    'status' => 'ok',
                    'info' => $password
                ];

            } else {
                return [
                    'status' => 'error',
                    'message' => globalHelper()->ajaxErrorResponse('User not found!')
                ];
            } 
            
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        } catch(QueryException $qe) {
            
            Log::channel('info')->info("Exception : ".$qe->getMessage());
            $errorCode = $qe->errorInfo[1];
            if($errorCode == 1062){
                return [
                    'status' => 'error',
                    // 'message' => 'Duplicate entry for user with employee: '. $validated['validated']['emp_id'] . ' and email : '.$validated['validated']['email']
                ];
            }

            throw new GlobalException();
            
        } catch (Exception $e) {
            Log::channel('info')->info("Exception : ".$e->getMessage());
            throw new GlobalException();
        }
    }

    public function deleteNonAdminUser($id, Request $request) {
        try {

            $user = User::find($id);
            if ($user) {
                $user->update(['status' => 6]);

                return [
                    'status' => 'ok',
                    'info' => ''
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => globalHelper()->ajaxErrorResponse('User not found!')
                ];
            } 
            
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        } catch(QueryException $qe) {
            
            Log::channel('info')->info("Exception : ".$qe->getMessage());
            $errorCode = $qe->errorInfo[1];
            if($errorCode == 1062){
                return [
                    'status' => 'error',
                    // 'message' => 'Duplicate entry for user with employee: '. $validated['validated']['emp_id'] . ' and email : '.$validated['validated']['email']
                ];
            }

            throw new GlobalException();
            
        } catch (Exception $e) {
            Log::channel('info')->info("Exception : ".$e->getMessage());
            throw new GlobalException();
        }
    }

    public function send_email() {
        // jesthonymorales@gmail.com
        // sheillamaemolde@gmail.com
        $mail = Mail::to("shoneth.daps@gmail.com")->send(
            new EteeapMailer([
                'type' => 'test',
                'subject' => "ETEEAP-AU Registration",
                'view' => 'test_mailer',
            ])
        );
    }
}