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
                    "_confirm('Successfully registered, please verify your email!', '/verify-email');"
                );
            }
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage());
            return globalHelper()->ajaxErrorResponse('');
        } 
    }
}