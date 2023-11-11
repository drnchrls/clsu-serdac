<?php

namespace App\Http\Controllers\Staff\Library;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\DownloadDataset;
use App\Models\DownloadPublication;
use App\Models\Publication;
use App\Models\ResourDownload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    //
    public function downloadPublication(Publication $id){
        
        request()->validate(
        [
            'download_reason'=>'required|string',
        ]
        );     


        $save = DownloadPublication::create([
                'download_reason' => request()->download_reason,
                'download_publication_id' => $id->publication_id,
                'download_publication_title' => $id->publication_title,
                'download_publication_author' => $id->publication_author,
                'download_user_id' => Auth::guard('web')->user()->id,
                'download_user_gender' => Auth::guard('web')->user()->gender,
                'download_user_age' => Auth::guard('web')->user()->age,
                'download_user_occupation' => Auth::guard('web')->user()->occupation,
                'download_user_educational_level' => Auth::guard('web')->user()->educational_level,
                'download_date' => now(),
                ]);

            if($save){
                
                $filename = $id->publication_file;
                
                $rawData = Storage::disk('publication')->get($filename); // raw content
                $file = Storage::disk('publication')->getAdapter()->getMetadata($filename); // array with file info
                $convert = mb_convert_encoding($rawData, 'UTF-8', 'UTF-8');
                // return response($convert, 200)
                //     ->header('Content-Type', $file->mimeType())
                //     ->header('Content-Disposition', "attachment; filename=$filename");
                return response()->json([
                    'data' => $convert,
                    'mime_type' => $file->mimeType(),
                    'filename' => $filename,
                ]);
            }
            
        
    }
    public function downloadDataset(Dataset $id){
        
        request()->validate(
        [
            'download_reason'=>'required|string',
        ]
        );     


        $save = DownloadDataset::create([
                'download_reason' => request()->download_reason,
                'download_dataset_id' => $id->dataset_id,
                'download_dataset_title' => $id->dataset_title,
                'download_dataset_author' => $id->dataset_author,
                'download_user_id' => Auth::guard('web')->user()->id,
                'download_user_gender' => Auth::guard('web')->user()->gender,
                'download_user_age' => Auth::guard('web')->user()->age,
                'download_user_occupation' => Auth::guard('web')->user()->occupation,
                'download_user_educational_level' => Auth::guard('web')->user()->educational_level,
                'download_date' => now(),
                ]);

            if($save){
                
                $filename = $id->dataset_file;
                
                $rawData = Storage::disk('dataset')->get($filename); // raw content
                $file = Storage::disk('dataset')->getAdapter()->getMetadata($filename); // array with file info
                
                $convert = mb_convert_encoding($rawData, 'UTF-8', 'UTF-8');
                // return response($convert, 200)
                //     ->header('Content-Type', $file->mimeType())
                //     ->header('Content-Disposition', "attachment; filename=$filename");
                return response()->json([
                    'data' => $convert,
                    'mime_type' => $file->mimeType(),
                    'filename' => $filename,
                ]);
            }
            

        
        
    }
}
