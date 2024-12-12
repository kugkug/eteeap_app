<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExecOtpController extends Controller
{
    public function verify_email(Request $request) {
        try {
            
            $request->merge([
                'Email' => base64_decode(apiHelper()->custom_session($request, 'get', 'sess_verify_email'))
            ]);

            $response = apiHelper()->execute($request, '/api/verify-email', 'POST');
            // return $response;
            if ($response['status'] == "error") {
                return globalHelper()->ajaxErrorResponse($response['message']);
            } else {
                return globalHelper()->ajaxSuccessResponse(
                    "_confirmUpdate('Email successfully verified!', '/');"
                );
            }
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage());
            return globalHelper()->ajaxErrorResponse('');
        } 
    }
}