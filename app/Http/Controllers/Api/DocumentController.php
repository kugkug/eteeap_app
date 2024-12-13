<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GlobalException;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function upload(Request $request) {
        try {
            $validated = validatorHelper()->validate('document_upload', $request);
            
            if ($validated['status'] === "error") {
                return $validated;
            }
            
            if (isset($validated['validated']['document'])) {
                $image = $request->file('Document');
                
                $ext = $image->getClientOriginalExtension();
                $filename = Auth::id()."_".date("YmdHis") .".".$ext;
                $orig = $image->getClientOriginalName();
                $request->file('Document')->storeAs('', $filename, 'upload_document');
                $validated['validated']['photo'] = $filename;

                $document_data = [
                    'user_id' => Auth::id(),
                    'original_filename' => $orig,
                    'filename' => $filename,
                ];

                $company = Document::create($document_data);

                return [
                    'status' => 'ok',
                    'info' => $company,
                ];
            }
            
            return ['status' => 'error'];

        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        } catch(QueryException $qe) {
            
            Log::channel('info')->info("Exception : ".$qe->getMessage());
            $errorCode = $qe->errorInfo[1];
            if($errorCode == 1062){
                return [
                    'status' => 'error',
                    'message' => 'Duplicate entry for company with code: '. $validated['validated']['code']
                ];
            }
            
        } catch (Exception $e) {
            Log::channel('info')->info("Exception : ".$e->getMessage());
            throw new GlobalException();
        }
    }
}