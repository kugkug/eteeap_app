<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExecApplicantController extends Controller
{
    public function save(Request $request) {
        try {
            
            $response = apiHelper()->execute($request, '/api/register', 'POST');
            
            if ($response['status'] == "error") {
                return globalHelper()->ajaxErrorResponse($response['message']);
            } else {
                return globalHelper()->ajaxSuccessResponse(
                    "_confirmUpdate('Successfully registered, please verify your email!', '/verify-email?email=".$response['email']."');"
                );
            }
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage());
            return globalHelper()->ajaxErrorResponse('');
        } 
    }

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
            
            
            return redirect('/dashboard');

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

        return redirect('/');
    }
}