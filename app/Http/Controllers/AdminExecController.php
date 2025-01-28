<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminExecController extends Controller
{
    public function login(Request $request) {
        try {
            $response = apiHelper()->execute($request, '/api/login', 'POST');

            if ($response['status'] === 'error') {
                return back()->withErrors([
                    'message' => $response['message']
                ])->onlyInput('email');
            }

            apiHelper()->custom_session(
                $request,
                'set',
                [
                    'sess_token_type' => $response['info']['token_type'],
                    'sess_token' => $response['info']['access_token']
                ],
            );

            if ($response['info']['user_type'] === config("users.admin")) {
                return redirect('/administrator');
            } else {
                return redirect('/');
            }

        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage());
            return globalHelper()->webErrorResponse('');
        }
    }

    public function logout(Request $request) {
        $response = apiHelper()->execute($request, '/api/logout', 'GET');

        if ($response['status'] === 'error') {
            return back()->withErrors([
                'message' => $response['info']['message']
            ])->onlyInput('email');
        }

        apiHelper()->custom_session($request, 'flush', '');
        $request->session()->invalidate();

        return redirect('/admin');
    }

    public function list(Request $request) {
        try {
            $response = apiHelper()->execute($request, '/api/applications/list', 'POST');

            
            if ($response['status'] == "error") {
                return globalHelper()->ajaxErrorResponse($response['message']);
            } else {
                
                $html_view = viewHelper()->createApplicantsTable($response);
                return globalHelper()->ajaxSuccessResponse($html_view);
            }
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function process(Request $request) {
        try {
            $response = apiHelper()->execute($request, '/api/applications/process', 'POST');
            
            if ($response['status'] == "error") {
                return globalHelper()->ajaxErrorResponse($response['message']);
            } else {
                
                return globalHelper()->ajaxSuccessResponse($response['message']);
                
                // $html_view = viewHelper()->createApplicantsTable($response);
                // return globalHelper()->ajaxSuccessResponse($html_view);
            }
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function invite(Request $request) {
        try {
            $response = apiHelper()->execute($request, '/api/applications/invite', 'POST');
            if ($response['status'] == "error") {
                return globalHelper()->ajaxErrorResponse($response['message']);
            } else {
                
                return globalHelper()->ajaxSuccessResponse($response['message']);
                
                // $html_view = viewHelper()->createApplicantsTable($response);
                // return globalHelper()->ajaxSuccessResponse($html_view);
            }
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }

    public function download(Request $request) {
        try {
            $response = apiHelper()->execute($request, '/api/applications/download', 'POST');
            
            if ($response['status'] == "error") {
                return globalHelper()->ajaxErrorResponse($response['message']);
            } else {
                
                return globalHelper()->ajaxSuccessResponse($response['message']);
                
                // $html_view = viewHelper()->createApplicantsTable($response);
                // return globalHelper()->ajaxSuccessResponse($html_view);
            }
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }
}