<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GlobalException;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function list()
    {
        try {
            $applicants = User::where('access_type', 1)->orderBy('lastname', 'asc')->paginate(1);
            
            return [
                'status' => 'ok',
                'list' => $applicants
            ];
                
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        }
    }

    public function process(Request $request)
    {
        if ($request->action == "approve") {
            $status = 1;
            $message = "_systemAlert('info', 'File Approved')";
        } else {
            $status = 2;
            $message = "_systemAlert('alert', 'Revision Requested')";
        }

        $data = [
            'status' => $status,
            'notes' => addslashes($request->notes)
        ];

        Document::find($request->id)->update($data);
        try {
            
            return [
                'status' => 'ok',
                'message' => $message
            ];
                
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        }
    }
    
}