<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GlobalException;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function upload(Request $request) {
        try {

            $files = $request->file('Documents');
            $req_types = $request->Types;
            $document_data = [];
            $x = 0;
            $origs = [];
            
            foreach($files as $file) {
                $type = $req_types[$x];
                
                $ext = $file->getClientOriginalExtension();
                $orig = str_replace("'", "", $file->getClientOriginalName());
                $orig_file = str_replace(".pdf", "", $orig);
                $filename = Auth::id()."_".str_replace(" ", "_", $orig_file).".".$ext;
                $file->storeAs('', $filename, 'upload_document');
                
                $document_data[] = [
                    'user_id' => Auth::id(),
                    'requirement_id' => $type,
                    'original_filename' => $orig,
                    'filename' => $filename,
                    'created_at' => Carbon::now()->format("Y-m-d H:i:s")
                ];

                $origs[] = $orig;

                $x++;
            }

            Document::insert($document_data);
            $files = join("<br />", $origs);
            
            globalHelper()->logTimeline(0, 'upload', $files);

            return [
                'status' => 'ok',
                'info' => '',
            ];

        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        } catch (Exception $e) {
            Log::channel('info')->info("Exception : ".$e->getMessage());
            throw new GlobalException();
        }
    }

    public function remove(Request $request) {
        try {
 
            Document::where('id', $request->id)->delete();
            
            return [
                'status' => 'ok',
                'message' => "$('#card-doc-".$request->id."').fadeOut();",
            ];

        } catch(GlobalException $ge) {
            Log::channel('info')->info("Global : ".$ge->getMessage());
            throw new GlobalException($ge->getMessage());
        } catch (Exception $e) {
            Log::channel('info')->info("Exception : ".$e->getMessage());
            throw new GlobalException();
        }
    }
}