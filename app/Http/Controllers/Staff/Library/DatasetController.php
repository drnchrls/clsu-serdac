<?php

namespace App\Http\Controllers\Staff\Library;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\DatasetCiteCount;
use App\Models\DatasetViewCount;
use App\Models\DownloadDataset;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DatasetController extends Controller
{
    //
    public function index(DownloadDataset $downloadDatasets){
        $publications = Publication::latest()->take(3)->get();
        $query = Dataset::query();

        if (request('search')) {
            $query
                ->where('dataset_title', 'like', '%' . request('search') . '%')
                ->orWhere('dataset_author', 'like', '%' . request('search') . '%')
                ->orWhere('dataset_contributor', 'like', '%' . request('search') . '%');
        }

        // if (request()->has(['field', 'sort']) && request()->field != null) {
        //     $query->orderBy(request('field'), request('sort'));
        // }
        return view('index.datasets', ['datasets'=>$query->paginate(10), 'publications'=>$publications, 'downloadDatasets'=>$downloadDatasets]);
        // $datasets = Dataset::latest()->get();
        // return view('index.datasets', ['datasets'=>$datasets]);
    }
    public function dataset(){
        // $sliders = [];
        if(request()->ajax()){
            $datasets = Dataset::latest()->get();
            return Datatables::of($datasets)
                ->addIndexColumn()
                ->addColumn('dataset_file', function ($row) {
                    
                    return '<a href="'.url($row->dataset_file_path).'" target="_blank" rel="noopener noreferrer">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </a>';
                })
                ->addColumn('action', function($row){
                    // $button = '<a href="'.url('dataset_id=').$row->dataset_id.'" id="viewDataset" class="btn btn-info btn-sm p-1 mx-1 rounded-circle text-light" name="view" data-id="'.$row->dataset_id.'" data-file="'.url($row->dataset_file_path).'"><span class="material-symbols-outlined">visibility</span></a>';
                    $button = '<a href="'.url('admin/datasets/edit')."/id=".$row->dataset_id.'" id="editDataset" class="btn btn-sm p-1 mx-1 rounded-circle bg-dark text-light" name="edit" data-id="'.$row->dataset_id.'" data-file="'.url($row->dataset_file_path).'" data-link="'.url('dataset_id='.$row->dataset_id).'"><span class="material-symbols-outlined rotate">settings</span></a>';
                    // $button = '<a href="'.url('admin/datasets/delete')."/id=".$row->dataset_id.'" id="deleteDataset" class="btn btn-sm p-1 mx-1 rounded-circle light-danger text-light " name="delete" data-id="'.$row->dataset_id.'"><span class="material-symbols-outlined">delete</span></a>';
                    return $button;
                    
                })
                ->rawColumns(['dataset_file','action'])
                ->make(true);
        }
        return view('management.e-library.dataset');
    }
    public function storeDataset (){
        request()->validate([
            'dataset_title' => 'required|string',
            'dataset_author' => 'required|string',
            'dataset_description' => 'required|string',
            'dataset_contributor' =>  'string|nullable',
            'dataset_file' => 'required|file|mimes:pdf,xlsx,doc,docx',
            'dataset_date' => 'required|date',
 
        ]);

        $file = request()->file('dataset_file');
        $fileName = $file->getClientOriginalName();

        // $path = $dir.$fileName;
        $uploaded = Storage::disk('dataset')->put($fileName, file_get_contents($file->getRealPath()));
        $url = Storage::disk('dataset')->url($fileName);
        // Storage::url($fileName);
        if($uploaded){
            Dataset::create([
                'dataset_title' => request()->dataset_title,
                'dataset_author' => request()->dataset_author,
                'dataset_description' => request()->dataset_description,
                'dataset_file' => $fileName,
                'dataset_file_path' => $url,
                // 'dataset_file' => request()->dataset_file,
                'dataset_date' => request()->dataset_date,
                'dataset_contributor' => request()->dataset_contributor,

            ]);

            return response()->json(['success'=>'Document added!']);
        }
 

        // dd($request->announcement_image);
        return response()->json(['error'=>'Document not added!']);
    }
    public function editDataset(Dataset $id){
        return response()->json(['success' => true, 'message' => 'File Details','data' => $id ]);
    }

    public function updateDataset(Dataset $id){
        request()->validate([
            'dataset_title' => 'required|string',
            'dataset_author' => 'required|string',
            'dataset_contributor' => 'string|nullable',
            'dataset_description' => 'required|string',

        ], [], 
        [
            // Change field names to =>
            'dataset_title' => 'title',
            'dataset_author' => 'author',
            'dataset_description' => 'introduction',
            'dataset_contributor' => 'contributor',
 
        ]);

        $id->dataset_title = request()->dataset_title;
        $id->dataset_author = request()->dataset_author;
        $id->dataset_description = request()->dataset_description;
        $id->dataset_contributor = request()->dataset_contributor;
        $id->save();

    
        return response()->json(['success' => true,'message'=>'File updated!','data' => $id]);
    }
    public function viewCount(Dataset $id)
    {
        DatasetViewCount::create([
            'dataset_view_count_pub_id'=>$id->dataset_id,
        ]);
        return response()->json(['success' => 'View Count Created']);
    }

    public function viewDataset(Dataset $id, DownloadDataset $downloadDatasets){
        $datasets = Dataset::inRandomOrder()->take(5)->get();
        $view_count = DatasetViewCount::where('dataset_view_count_pub_id', $id->dataset_id)->get()->count();

        return view('index.view_dataset', ['view_datasets'=>$id, 'current_user' => Auth::user(), 'downloadDatasets'=>$downloadDatasets, 'relatedDatasets'=>$datasets, 'viewCount'=>$view_count]);
    }



    // public function generateCitation(Dataset $id)
    // {
    //     $create = DatasetCiteCount::create([
    //         'dataset_cite_count_pub_id'=> $id->dataset_id,
    //     ]);
    //     if($create){
    //         return response()->json(['message' => 'Cite count created']);
    //     }else{
    //         return response()->json(['message' => 'Cite count not created']);
    //     }
    // }
    public function deleteDataset(Dataset $id) {
        $filename = $id->dataset_file;
    
        $delete = Storage::disk('dataset')->delete($filename);
        if($delete){
            $id->delete();
            return response()->json(['success' => 'Photo deleted!']);
        }
    }
}
