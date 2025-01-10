<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExecDocumentController extends Controller
{
    public function upload(Request $request) {
        try {
            $response = apiHelper()->execute($request, '/api/document/upload', 'POST');

            if ($response['status'] == "error") {
                return globalHelper()->ajaxErrorResponse($response['message']);
            } else {
                return globalHelper()->ajaxSuccessResponse(
                    "_confirmUpdate('File successfully uploaded!', '/uploads')"
                );
            }
        } catch (Exception $e) {
            Log::channel('info')->info($e->getMessage());
            return globalHelper()->ajaxErrorResponse('');
        }   
    }

    public function remove(Request $request) {
        try {
            $response = apiHelper()->execute($request, '/api/document/remove', 'POST');

            if ($response['status'] == "error") {
                return globalHelper()->ajaxErrorResponse($response['message']);
            } else {
                
                return globalHelper()->ajaxSuccessResponse($response['message']);
            }
        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return globalHelper()->ajaxErrorResponse('');
        }
    }
}