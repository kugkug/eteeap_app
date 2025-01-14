<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Mail\EteeapMailer;
use App\Models\Document;
use App\Models\Otp;
use App\Models\Profile;
use App\Models\Requirement;
use App\Models\Timeline;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class GlobalHelper {
 
    private static function getMessages() {
        return config('custom.messages');
    }

    private function getViewData(Request $request) {
        $themes = config('custom.theme_mode');
        
        $viewData['settings'] = $request->current_user_settings ? 
        [ 'theme_class' => $themes[$request->current_user_settings['theme_mode']] ] :
        [ 'theme_class' => $themes['light'] ];
        
        return $viewData;
    }

    public function webErrorResponse(string $message=''): RedirectResponse {
        $messages = self::getMessages();
        
        $msg = ( ! empty($message) ) ? $message : $messages['default'];
        return back()->withErrors([
            'message' => $msg
        ])->withInput();
    }

    public function ajaxErrorResponse(string $message='', string $url=''): JsonResponse {
        Log::channel('info')->info($message);
        $messages = self::getMessages();
        $msg = ( ! empty($message) ) ? $message : $messages['default'];
        $js = ['js' => "_confirm('alert', '".$msg."');"];
        return response()->json($js, 200);
    }

    public function ajaxSuccessResponse(string $scripts): JsonResponse {
        $scripts = preg_replace('/\r\n+/S', "", $scripts);
        return response()->json(['js' => $scripts], 200);
    }

    public function makeView(string $view, array $data, Request $request): View {
        return view($view, $data)->with(self::getViewData($request));
    }

    public function genDefaultPassword() {
        return substr(str_shuffle('1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz!@#$%^&*()_-+'), 0, 8);
    }

    public function genOtp() {
        return strtoupper(substr(str_shuffle('1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'), 0, 6));
    }

    public function genPlayerCode() {
        return "PLR-".date("YmdHis").substr(str_shuffle('1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
    }

    public function genAgentCode() {
        return "AGT-".date("YmdHis").substr(str_shuffle('1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
    }

    public function genCompanyCode() {
        return "CPY-".date("YmdHis").substr(str_shuffle('1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
    }

    public function sendEmail(string $type, string $identity, array $data): bool {
        try {

            Mail::to($identity)->send( new EteeapMailer( [ 'type' => $type, 'data' => $data ]));
            return true;

        } catch(Exception $e) {

            Log::channel('info')->info("Exception : ".$e->getMessage());
            return false;   
            
        }
    }

    public function confirmOtp(string $identity, string $req_otp): array {

        try {
            $otp_data = Otp::where('identity', $identity)->first();
            if ($otp_data) {

                $otp_data_arr = $otp_data->toArray();
                $otp = $otp_data_arr['otp'];
                $is_verified = $otp_data_arr['is_verified'];
                $created_at = Carbon::parse($otp_data_arr['updated_at']);

                $diff_in_mins = $created_at->diffInMinutes(now());

                if ($is_verified || $otp != $req_otp) {
                    return [
                        'status' => 'error',
                        'message' => 'Invalid Otp',
                    ];
                }

                if ($diff_in_mins >= env('APP_OTP_DURATION_MINS', 5)) {
                    return [
                        'status' => 'error',
                        'message' => 'OTP has expired!'
                    ];
                }

                return [
                    'status' => 'ok',
                    'message' => 'OTP confirmed!'
                ];
                
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Record not found!'
                ];
            }
        } catch(Exception $e) {
            
            Log::channel('info')->info("Exception : ".$e->getMessage());
            return [
                'status' => 'error',
                'message' => 'System Error'
            ];
        }       
    }

    public function getApplicantDocuments(int $user_id): array {
        
        try {
            $requirements = [];

            $documents = Document::where('user_id', $user_id)
            ->with('requirements')
            ->get();

            foreach($documents->toArray() as $document) {
                $requirement_id = $document['requirements']['id'];

                unset($document['requirements']);
                
                $requirements[$requirement_id][] = $document;
            }

            return $requirements;

        } catch(Exception $e) {
            
            Log::channel('info')->info("Exception : ".$e->getMessage());
            return [];
        }       
    }

    public function getDocument(int $document_id): array {
        try {
            
            $documents = Document::where('id', $document_id)->get();
            
            return $documents->toArray()[0];

        } catch(Exception $e) {
            
            Log::channel('info')->info("Exception : ".$e->getMessage());
            return [];
        }       
    }

    public function getRequirementTypes(): array {
        try {
            $req_types = Requirement::get();
            return $req_types->toArray();

        } catch(Exception $e) {
            
            Log::channel('info')->info("Exception : ".$e->getMessage());
            return [];
        }   
    }

    public function getApplicantInformation(int $id) {
        try {
            $user = User::where('id', $id)->get();
            
            
            return $user->toArray()[0];

        } catch(Exception $e) {
            
            Log::channel('info')->info("Exception : ".$e->getMessage());
            return [];
        }  
    }

    public function getApplicantProfile(int $id=0) {
        try {
            $profile = Profile::where('user_id', $id)->get();
        
            return $profile->toArray()[0];

        } catch(Exception $e) {
            
            Log::channel('info')->info("Exception : ".$e->getMessage());
            return [
                'address' => '',
                'position' => '',
                'company' => '',
                'company_address' => '',
                'skills' => '',
            ];
        }  
    }

    public function getTimeline(int $sender_id, int $recipient_id): array {
        try {
            $arr_timelines = [];
            $timelines = Timeline::where('sender_id', $sender_id)
            ->orWhere('recipient_id', $recipient_id)
            ->orderBy('created_at', 'desc')
            ->with('sender')
            ->with('recipient')
            ->get();
            
            foreach($timelines->toArray() as $timeline) {
                $date = Carbon::parse($timeline['created_at'])->format('Y-m-d');
                $arr_timelines[$date][] = $timeline;
            }
            
            return $arr_timelines;

        } catch(Exception $e) {
            
            Log::channel('info')->info("Exception : ".$e->getMessage());
            return [];
        }  
    }

    public function logTimeline(int $recipient, string $action, string $description, string $assets= ''): void {
        $sender = Auth::id();

        Timeline::create([
            'sender_id' => $sender,
            'recipient_id' => $recipient,
            'action' => $action,
            'description' => $description,
        ]);
        return;
    }

    public function getDashboardData() {
        try {
            $user_info = DB::table('users')
                    ->select(DB::raw('count(*) as total'))
                    ->groupBy('application_status')
                    ->get();
            $documents = DB::table('documents')->get();

            return [
                'applications' => $user_info->toArray(),
                'documents' => count($documents)
            ];
        } catch(Exception $e) {
            Log::channel('info')->info("Exception : ".$e->getMessage());
            return [
                'applications' => [ ['total' => 0], ['total' => 0]],
                'documents' => 0
            ];
        }  
    }
        
}