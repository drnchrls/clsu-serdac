<?php

namespace App\Http\Controllers\Staff\Library;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\DownloadPublication;
use App\Models\Publication;

use App\Models\PublicationViewCount;
use App\Models\SubmissionPublication;
use App\Models\SubmissionResponse;
use App\Models\User;
use App\Notifications\SubmissionPublicationApproveNotification;
use App\Notifications\SubmissionPublicationRejectNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PublicationController extends Controller
{
//     //
    public function index(DownloadPublication $downloadPublications){
        
        $datasets = Dataset::latest()->take(3)->get();
        $query = Publication::query();

        if (request('search')) {
            $query
                ->where('publication_title', 'like', '%' . request('search') . '%')
                ->orWhere('publication_author', 'like', '%' . request('search') . '%')
                ->orWhere('publication_type', 'like', '%' . request('search') . '%');
        }

        
        $currentMonth = Carbon::now()->month;

        $topDownloadPublications = DownloadPublication::whereMonth('download_date', $currentMonth)
        ->select('download_publication_id')
        ->selectRaw('COUNT(download_publication_id) as count, download_publication_title, download_publication_author')
        ->groupBy('download_publication_id', 'download_publication_title', 'download_publication_author')
        ->orderBy('count', 'desc')
        ->limit(3)
        ->get();

        $topViewPublications = PublicationViewCount::with('publication')
        ->whereMonth('created_at', $currentMonth)
        ->select('publication_view_count_pub_id')
        ->selectRaw('COUNT(publication_view_count_pub_id) as count')
        ->groupBy('publication_view_count_pub_id')
        ->orderBy('count', 'desc')
        ->limit(3)
        ->get();

        return view('index.publications', ['publications'=>$query->paginate(10), 'datasets'=>$datasets, 'downloadPublications'=>$downloadPublications, 'topDownloadPublications'=>$topDownloadPublications, 'topViewPublications'=>$topViewPublications]);
        // $publications = Publication::latest()->get();
        // return view('index.publications', ['publications'=>$publications]);
    }
    
    public function publication(){
        // $sliders = [];
        if(request()->ajax()){
            $publications = Publication::latest()->get();
            return Datatables::of($publications)
                ->addIndexColumn()
                ->addColumn('publication_file', function ($row) {
                    
                    return '<a href="'.url($row->publication_file_path).'" target="_blank" rel="noopener noreferrer">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </a>';
                    // return '<img src="'.url('storage/'.$row->publication_file).'" border="0" width="40" class="rounded" align="center" />';
                })
                ->addColumn('action', function($row){
                    // $button = '<a href="'.url('pub_id=').$row->publication_id.'" id="viewPublication" class="btn btn-info btn-sm p-1 mx-1 rounded-circle text-light" name="view" data-id="'.$row->publication_id.'" data-file="'.url($row->publication_file_path).'"><span class="material-symbols-outlined">visibility</span></a>';
                    $button = '<a href="'.url('admin/publications/edit')."/".$row->publication_id.'" id="editPublication" class="btn btn-sm p-1 mx-1 rounded-circle bg-dark text-light" name="edit" data-id="'.$row->publication_id.'" data-file="'.url($row->publication_file_path).'" data-link="'.url('pub_id='.$row->publication_id).'"><span class="material-symbols-outlined rotate">settings</span></a></a>';
                    // $button .= '<a href="'.url('admin/publications/delete')."/".$row->publication_id.'" id="deletePublication" class="btn btn-sm p-1 mx-1 rounded-circle light-danger text-light " name="delete" data-id="'.$row->publication_id.'"><span class="material-symbols-outlined">delete</span></a>';
                    return $button;
                    
                })
                ->rawColumns(['publication_file','action'])
                ->make(true);
        }
        return view('management.e-library.publication');
    }

    public function storePublication(){
        request()->validate([
            'publication_title' => 'required|string',
            'publication_author' => 'required|string',
            'publication_description' => 'required|string',
            'publication_contributor' => 'string|nullable',
            'publication_file' => 'required|file|mimes:pdf,xlsx,doc,docx',
            'publication_type' => 'required|string',
            'publication_date' => 'required|date',
            'publication_citation' => 'string|nullable',
            'publication_volume' => 'string|nullable',
            'publication_issue' => 'string|nullable',
            'publication_theme' => 'required|string',
            'publication_publisher' => 'string|nullable',
            'publication_doi' => 'string|nullable',
        ]);

        $file = request()->file('publication_file');
        $fileName = $file->getClientOriginalName();

        // $path = $dir.$fileName;
        $uploaded = Storage::disk('publication')->put($fileName, file_get_contents($file->getRealPath()));
        $url = Storage::disk('publication')->url($fileName);
        if($uploaded){
            Publication::create([
                'publication_title' => request()->publication_title,
                'publication_author' => request()->publication_author,
                'publication_description' => request()->publication_description,
                'publication_contributor' => request()->publication_contributor,
                'publication_file' => $fileName,
                'publication_file_path' => $url,
                // 'publication_file' => request()->publication_file,
                'publication_type' => request()->publication_type,
                'publication_date' => request()->publication_date,
                'publication_citation' => request()->publication_citation,
                'publication_issue' => request()->publication_issue,
                'publication_volume' => request()->publication_volume,
                'publication_theme' => request()->publication_theme,
                'publication_publisher' => request()->publication_publisher,
                'publication_doi' => request()->publication_doi,
            ]);
{{  }}
            return response()->json(['success'=>'Document added!']);
        }
 

        // dd($request->announcement_image);
        return response()->json(['error'=>'Document not added!']);
    }
    public function editPublication(Publication $id){
        return response()->json(['success' => true, 'message' => 'File Details','data' => $id ]);
    }
    public function updatePublication(Publication $id){
        request()->validate([
            'publication_title' => 'required|string',
            'publication_author' => 'required|string',
            'publication_contributor' => 'string|nullable',
            'publication_description' => 'required|string',
            'publication_volume' => 'string|nullable',
            'publication_issue' => 'string|nullable',
            // 'publication_theme' => 'required|string',
            'publication_publisher' => 'string|nullable',
            'publication_doi' => 'string|nullable',
            
        ], [], 
        [
            // Change field names to =>
            'publication_title' => 'title',
            'publication_author' => 'author',
            'publication_description' => 'introduction',
            'publication_contributor' => 'contributor',
            'publication_volume' => 'volume',
            'publication_issue' => 'issue',
            // 'publication_theme' => 'theme',
            'publication_publisher' => 'publisher',
            'publication_doi' => 'DOI',
        ]);
        if($id->publication_type == 'Journal/Journal Article'){
            $id->publication_volume = request()->publication_volume;
            $id->publication_issue = request()->publication_issue;
            $id->publication_title = request()->publication_title;
            $id->publication_author = request()->publication_author;
            $id->publication_description = request()->publication_description;
            $id->publication_contributor = request()->publication_contributor;
            // $id->publication_theme = request()->publication_theme;
            $id->publication_publisher = request()->publication_publisher;
            $id->publication_doi = request()->publication_doi;
            $id->save();
        }else{
            $id->publication_title = request()->publication_title;
            $id->publication_author = request()->publication_author;
            $id->publication_description = request()->publication_description;
            $id->publication_contributor = request()->publication_contributor;
            // $id->publication_theme = request()->publication_theme;
            $id->publication_publisher = request()->publication_publisher;
            $id->publication_doi = request()->publication_doi;
            $id->save();
        }


            
    
        return response()->json(['success' => true,'message'=>'Photo updated!','data' => $id]);
    }

    public function viewCount(Publication $id)
    {

        PublicationViewCount::create([
            'publication_view_count_pub_id'=>$id->publication_id,
        ]);
        return response()->json(['success' => 'View Count Incremented']);
    }

    public function viewPublication(Publication $id, DownloadPublication $downloadPublications){

        $publications = Publication::inRandomOrder()->take(5)->get(); 
        // $cite_count = PublicationCiteCount::where('publication_cite_count_pub_id', $id->publication_id)->get()->count();
        $view_count = PublicationViewCount::where('publication_view_count_pub_id', $id->publication_id)->get()->count();
        
        return view('index.view_pub', ['view_pub'=>$id, 'current_user' => Auth::user(), 'downloadPublications'=>$downloadPublications, 'relatedPublications'=>$publications, 'viewCount'=>$view_count]);
    }


    // public function generateCitation(Publication $id)
    // {
    //     $create = PublicationCiteCount::create([
    //         'publication_cite_count_pub_id'=> $id->publication_id,
    //     ]);
    //     if($create){
    //         return response()->json(['message' => 'Cite count created']);
    //     }else{
    //         return response()->json(['message' => 'Cite count not created']);
    //     }
    // }

    public function deletePublication(Publication $id) {
        $filename = $id->publication_file;
    
        $delete = Storage::disk('publication')->delete($filename);
        if($delete){
            $id->delete();
            return response()->json(['success' => 'Photo deleted!']);
        }
    }


    public function publicationRequests(){

        $years = Publication::selectRaw('YEAR(created_at) as year')->groupBy( 'year')->get();
        $requestLogs = SubmissionResponse::with('submission')->latest()->get();
        $id = SubmissionPublication::with('user')->where('submission_publication_status', 'Pending')->latest()->get();
        $idA = SubmissionPublication::with('user')->where('submission_publication_status', 'Approved')->get();
        $idR = SubmissionPublication::with('user')->where('submission_publication_status', 'Rejected')->get();
        return view('management.e-library.publication_requests', ['requests'=>$id, 'requestLogs'=>$requestLogs, 'requestLogsApproved'=>$idA,'requestLogsRejected'=>$idR, 'years'=>$years]);
    }

    public function approve(SubmissionPublication $id){

        // request()->validate([
        //     'submission_response_remark'=>'nullable'
        // ]);

        $data = Publication::create([
            'publication_title' => $id->submission_publication_title,
            'publication_author' => $id->submission_publication_author,
            'publication_description' => $id->submission_publication_description,
            'publication_contributor' => $id->submission_publication_contributor,
            'publication_file' => $id->submission_publication_file,
            'publication_file_path' => $id->submission_publication_file_path,
            'publication_type' => $id->submission_publication_type,
            'publication_date' => $id->submission_publication_date,
            'publication_issue' => $id->submission_publication_issue,
            'publication_volume' => $id->submission_publication_volume,
            'publication_theme' => $id->submission_publication_theme,
            'publication_publisher' => $id->submission_publication_publisher,
            'publication_doi' => $id->submission_publication_doi,
        ]);

        if($data){
            $id->submission_publication_status = 'Approved';
            $id->save();
        }
        
        SubmissionResponse::create([
            'submission_response_request_id'=>$id->submission_publication_id,
            'submission_response_remark'=>'',
        ]);

        $remarks = '';
        $title = $id->submission_publication_title;
        $name = $id->user->fname.' '.$id->user->lname;
        $subject = 'Request Approved';
        $level = 'success';
        $message = 'Your submission of publication request of "'.$title.'" has been approved.';
        Notification::route('mail', $id->user->email)->notify(new SubmissionPublicationApproveNotification($level, $message, $name, $subject, $remarks));
        
        return response()->json(['success' => 'Approved!']);
        // return redirect('admin/publications/requests')->with('success', 'APPROVED!');
    }

    public function reject(SubmissionPublication $id){

        request()->validate([
            'submission_response_remark'=>'required|string',
        ]);

        $filename = $id->submission_publication_file;
        $delete = Storage::disk('publication')->delete($filename);

        // if($delete){
            $id->submission_publication_status = 'Rejected';
            $id->save();
        // }

        SubmissionResponse::create([
            'submission_response_request_id'=>$id->submission_publication_id,
            'submission_response_remark'=>request()->submission_response_remark,
        ]);

        $remarks = request()->submission_response_remark;
        $level = 'error';
        $title = $id->submission_publication_title;
        $name = $id->user->fname.' '.$id->user->lname;
        $subject = 'Request Rejected';
        $message = 'Your submission of publication request of "'.$title.'" has been rejected.';
        Notification::route('mail', $id->user->email)->notify(new SubmissionPublicationRejectNotification($level, $message, $name, $subject, $remarks));

        return response()->json(['success' => 'Approved!']);
        // return redirect('admin/publications/requests')->with('success', 'REJECTED!');
    }
}
