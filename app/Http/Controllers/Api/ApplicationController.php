<?php

namespace App\Http\Controllers\Api;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Exceptions\GlobalException;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class ApplicationController extends Controller
{
    public function list(Request $request)
    {
        try {
            if ($request->course != "") {
                $applicants = User::where('users.access_type', 1)
                ->where('profiles.desired_course', $request->course)
                ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
                ->with('profiles')
                ->orderBy('users.lastname', 'asc')
                ->paginate(10, ['users.*', 'profiles.*', 'users.id as user_id', 'profiles.id as profile_id', 'profiles.user_id as user_profile_id']);
            } else {
                $applicants = User::where('access_type', 1)
                ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
                ->orderBy('lastname', 'asc')
                ->paginate(10, ['users.*', 'profiles.*', 'users.id as user_id', 'profiles.id as profile_id', 'profiles.user_id as user_profile_id']);
            }
            
            
            return [
                'status' => 'ok',
                'list' => $applicants
            ];
                
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        }
    }

    public function batch_list(Request $request)
    {
        try {
            if ($request->course != "") {
                $applicants = User::where('users.access_type', 1)
                ->where('profiles.desired_course', $request->course)
                ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
                ->with('profiles')
                ->orderBy('users.lastname', 'asc')
                ->get(['users.*', 'profiles.*', 'users.id as user_id', 'profiles.id as profile_id', 'profiles.user_id as user_profile_id']);
            } else {
                $applicants = User::where('access_type', 1)
                ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
                ->orderBy('lastname', 'asc')
                ->get(['users.*', 'profiles.*', 'users.id as user_id', 'profiles.id as profile_id', 'profiles.user_id as user_profile_id']);
            }

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
                $status = config('custom.doc_status')['Approved'];
                $message = "_systemAlert('info', 'File Approved')";

                
            } else {
                $status = config('custom.doc_status')['Rejected'];
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

            User::where('id', $request->applicant_id)->update(['application_status' => config('custom.application_status')['Passed']]);
            
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

    public function batch_invite(Request $request)
    {        
        try {
            $invited_ids = $request->invited_ids;
            
            $approved_course = $request->ApprovedCourse;
            $interview_date = $request->InterviewDate;
            $interview_time = $request->InterviewTime;
            
            $user_infos = User::whereIn('id', $invited_ids)->get()->toArray();

            $arr_is_sent = [];
            foreach($user_infos as $user_info ) {
                $is_sent = globalHelper()->sendEmail('invite', 'jesthonymorales@gmail.com', [
                    'fname' => ucfirst(strtolower($user_info['firstname'])),
                    'course' => config('custom.courses')[$approved_course],
                    'date' => date("F d, Y", strtotime($interview_date)),
                    'time' => date("H:i a", strtotime($interview_time)),
                ]);

                $arr_is_sent[] = $is_sent;

                User::where('id', $user_info['id'])->update(['application_status' => config('custom.application_status')['Passed']]);
                Document::where('user_id', $user_info['id'])->update(['status' => config('custom.doc_status')['Approved']]);
                Profile::where('user_id', $user_info['id'])->update(['approved_course' => $approved_course]);
            }

            return [
                'status' => 'ok',
                'message' => "_confirm('info', 'Applicants Notified!')",
                'is_sent' => $arr_is_sent,
            ];
                
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            return ['status' => 'error'];
            // throw new GlobalException($ge->getMessage());
        } catch(Exception $e) {
            Log::channel('info')->info("Exceptioon : ".$e->getMessage());
            return ['status' => 'error'];
            // throw new GlobalException($ge->getMessage());
        }
    }
    
    public function download(Request $request)
    {
        try { 
            $applicant = globalHelper()->getApplicantInformation($request->id);
            $documents = globalHelper()->getApplicantDocuments($request->id);

            $zip = new \ZipArchive();
            $zip_filename = $applicant['firstname']."_".$applicant['lastname']."_documents.zip";

            $create_zip_file = $zip->open(public_path("zips/$zip_filename"), \ZipArchive::CREATE);
            if ($create_zip_file == true) {
                foreach($documents as $files) {
                    foreach($files as $document) {
                        $value = public_path("documents/").$document['filename'];
                        $relativeName = basename($value);
                        $zip->addFile($value, $relativeName);
                    }
                }

                $zip->close();
            }

            $url = url("zips/$zip_filename");
            
            $js = " var anchor = document.createElement('a');
                    anchor.href = '".$url."';
                    anchor.download = '".$zip_filename."';
                    document.body.append(anchor);
                    anchor.click();
                    setTimeout(function () {
                        document.body.removeChild(anchor);
                    }, 1);
                ";
                
            return [
                'status' => 'ok',
                'message' => $js,
            ];
                
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            return ['status' => 'error'];
        } catch(Exception $e) {
            Log::channel('info')->info("Global : ".$e->getMessage());
            return ['status' => 'error'];
        }
    }

    public function download_pdf(Request $request)
    {
        try {
            if ($request->course != "") {
                $applicants = User::where('users.access_type', 1)
                ->where('profiles.desired_course', $request->course)
                ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
                ->with('profiles')
                ->orderBy('users.lastname', 'asc')
                ->get(['users.*', 'profiles.*', 'users.id as user_id', 'profiles.id as profile_id', 'profiles.user_id as user_profile_id'])->toArray();
            } else {
                $applicants = User::where('access_type', 1)
                ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
                ->orderBy('lastname', 'asc')
                ->get(['users.*', 'profiles.*', 'users.id as user_id', 'profiles.id as profile_id', 'profiles.user_id as user_profile_id'])->toArray();
            }
            
            $pdf = PDF::loadView('pdfs.applications', ['list' => $applicants]);
            $path = public_path('pdfs/');
            $fileName =  'Applications_'.date("YmdHis").'.pdf';
            $pdf->save($path . '/' . $fileName);
            $pdf->download($fileName);

            $url = url("pdfs/$fileName");
            $js = " var anchor = document.createElement('a');
                    anchor.href = '".$url."';
                    anchor.download = '".$fileName."';
                    document.body.append(anchor);
                    anchor.click();
                    setTimeout(function () {
                        document.body.removeChild(anchor);
                    }, 1);
                ";
                
            return [
                'status' => 'ok',
                'message' => $js,
            ];
            
        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            return ['status' => 'error'];
        } catch(Exception $e) {
            Log::channel('info')->info("Global : ".$e->getMessage());
            return ['status' => 'error'];
        }
    }

    
}