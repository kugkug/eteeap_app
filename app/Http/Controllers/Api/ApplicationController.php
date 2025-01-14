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
        try {
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

            $document = globalHelper()->getDocument($request->id);
            
            globalHelper()->logTimeline($document['user_id'], $request->action, 
                $document['original_filename']."<br />".$request->notes
            );
        
        
            
            return [
                'status' => 'ok',
                'message' => $message
            ];
                
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        }
    }

    public function invite(Request $request)
    {        
        try {
            
            $user_info = User::where('id', $request->applicant_id)->get()->toArray()[0];

            globalHelper()->sendEmail('invite', $user_info['email'], ['fname' => $user_info['firstname']]);

            User::where('id', $request->applicant_id)->update(['application_status' => 1]);
            
            return [
                'status' => 'ok',
                'message' => "_systemAlert('info', 'Applicant Notified!')",
            ];
                
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            return ['status' => 'error'];
            // throw new GlobalException($ge->getMessage());

            
        }
    }
    
}