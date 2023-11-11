<?php

namespace App\Http\Controllers\Staff\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Dataset;
use App\Models\Gallery;
use App\Models\Publication;
use App\Models\Slider;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\VisitorCount;

class CMSController extends Controller
{
    // LANDING PAGE!!!!
    public function index(Request $request){

         // Check if a 'visitorCount' key exists in the user's session
        if ($request->session()->has('visitorCount')) {
        // If it exists, increment the count
        $visitorCount = $request->session()->get('visitorCount') + 1;
        } else {
        // If it doesn't exist, initialize the count
        $visitorCount = 1;
        }

        // Store the updated count in the session
         $request->session()->put('visitorCount', $visitorCount);
         
        // 
        $sliders = Slider::all();
        $announcements = Announcement::all();
        $galleries = Gallery::all();
        $countDatasets = Dataset::count(); 
        $countPublications = Publication::count(); 
        return view('index.content', ['sliders'=>$sliders, 'announcements'=>$announcements, 'galleries'=>$galleries, 'countDatasets'=>$countDatasets,'countPublications'=>$countPublications, 'visitorCount' => $visitorCount]);
        
    }
    public function slider(){
        // $sliders = [];
        if(request()->ajax()){
            $sliders = Slider::latest()->get();
            return Datatables::of($sliders)
                ->addIndexColumn()
                ->addColumn('slider_image', function ($row) {
                    return '<img src="'.url('storage/'.$row->slider_image).'" border="0" width="40" class="rounded" align="center" />';
                })
                ->addColumn('action', function($row){
    
                    $button = '<a href="'.url('admin/sliders/edit')."/".$row->slider_id.'" id="editSlider" class="btn btn-sm p-1 mx-1 rounded-circle bg-dark text-light" name="edit" data-id="'.$row->slider_id.'" data-image="'.url('storage/'.$row->slider_image).'"><span class="material-symbols-outlined rotate">settings</span></a>';
                    // $button .= '<a href="'.url('admin/sliders/delete')."/".$row->slider_id.'" id="deleteSlider" class="btn btn-sm p-1 mx-1 rounded-circle light-danger text-light " name="delete" data-id="'.$row->slider_id.'"><span class="material-symbols-outlined">delete</span></a>';
                    return $button;
                    
                })
                ->rawColumns(['slider_image','action'])
                ->make(true);
        }
        return view('management.admin.slider');
    }

    public function storeSlider(){
         // $request->validate([
        // 'announcement_title' => 'required|string|max:255',
        // 'announcement_description' => 'required|string|max:255',
        // 'announcement_image' => 'required|file|mimes:jpg,png,jpeg,svg|max: 2000'
        // ]);
        // $uploadImage = $request->file('announcement_image');
        // $imageNameWithExt = $uploadImage->getClientOriginalName(); 
        // $imageName =pathinfo($imageNameWithExt, PATHINFO_FILENAME);
        // $imageExt=$uploadImage->getClientOriginalExtension();
        // $storeImage=$imageName . time() . "." . $imageExt;
        // $request->announcement_image->move(public_path('image'), $storeImage);
        
        // Slider::create([
        //     'announcement_title' => $request->announcement_title,
        //     'announcement_description' => $request->announcement_description,
        //     'announcement_image' => $storeImage,
        // ]);
        request()->validate([
            'slider_title' => 'required|string|max:255',
            'slider_description' => 'required|string',
            'slider_image' => 'required|file|mimes:jpg,png,jpeg|max:2048'
        ]);

        $image_path = request()->file('slider_image')->store('images/slider', 'public');

        Slider::create([
            'slider_title' => request()->slider_title,
            'slider_description' => request()->slider_description,
            'slider_image' => $image_path,
        ]);

        // dd($request->announcement_image);
        return response()->json(['success'=>'Account created!']);
    }
    public function editSlider(Slider $id){
        $image = $id->slider_image;
        return response()->json(['success' => true, 'message' => 'Slider Details','data' => $id]);
    
    }

    public function updateSlider(Slider $id){
        request()->validate([
            'slider_title' => ['required', 'string', 'max:255'],
            'slider_description' => ['required', 'string'],
        ], [], 
        [
            // Change field names to =>
            'slider_title' => 'title',
            'slider_description' => 'description',
        ]);
            $id->slider_title = request()->slider_title;
            $id->slider_description = request()->slider_description;
            $id->save();
    
        return response()->json(['success' => true,'message'=>'Account updated!','data' => $id]);
    }

    public function deleteSlider(Slider $id){
        
        $image_path = public_path('storage').'/'.$id->slider_image;
        unlink($image_path);
        $id->delete();
        return response()->json(['success' => 'Slider deleted!']);
    
    }

    // ANNOUNCEMENT
    public function announcement(){
        // $sliders = [];
        if(request()->ajax()){
            $announcements = Announcement::latest()->get();
            return Datatables::of($announcements)
                ->addIndexColumn()
                ->addColumn('announcement_image', function ($row) {
                    return '<img src="'.url('storage/'.$row->announcement_image).'" border="0" width="40" class="rounded" align="center" />';
                })
                ->addColumn('action', function($row){
                    // $button = '<a href="'.url('blog_id=').$row->announcement_id.'" id="viewAnnouncement" class="btn btn-info btn-sm p-1 mx-1 rounded-circle text-light" name="view" data-id="'.$row->announcement_id.'" data-image="'.url('storage/'.$row->announcement_image).'"><span class="material-symbols-outlined">visibility</span></a>';
                    $button = '<a href="'.url('admin/announcements/edit')."/".$row->announcement_id.'" id="editAnnouncement" class="btn btn-sm p-1 mx-1 rounded-circle bg-dark text-light" name="edit" data-id="'.$row->announcement_id.'" data-image="'.url('storage/'.$row->announcement_image).'"><span class="material-symbols-outlined rotate">settings</span></a>';
                    // $button .= '<a href="'.url('admin/announcements/delete')."/".$row->announcement_id.'" id="deleteAnnouncement" class="btn btn-sm p-1 mx-1 rounded-circle light-danger text-light " name="delete" data-id="'.$row->announcement_id.'"><span class="material-symbols-outlined">delete</span></a>';
                    return $button;
                    
                })
                ->rawColumns(['announcement_image','action'])
                ->make(true);
        }
        return view('management.admin.announcement');
    }

    public function viewAnnouncement(Announcement $id){
        return view('index.blog', ['announcements'=>$id,]);
    }

    public function storeAnnouncement(){
       request()->validate([
           'announcement_title' => 'required|string|max:255',
           'announcement_description' => 'required|string',
           'announcement_image' => 'required|file|mimes:jpg,png,jpeg|max:2048',
           'announcement_type' => 'required|string',
           'announcement_links' => 'string|nullable',
       ]);

       $image_path = request()->file('announcement_image')->store('images/announcement', 'public');

       Announcement::create([
           'announcement_title' => request()->announcement_title,
           'announcement_description' => request()->announcement_description,
           'announcement_image' => $image_path,
           'announcement_type' => request()->announcement_type,
           'announcement_links' => request()->announcement_links,
       ]);

       // dd($request->announcement_image);
       return response()->json(['success'=>'Account created!']);
   }
    // public function deleteAnnouncement(Announcement $id){
        
    //     $image_path = public_path('storage').'/'.$id->announcement_image;
    //     unlink($image_path);
    //     $id->delete();
    //     return response()->json(['success' => 'Announcement deleted!']);
    
    // }
    public function editAnnouncement(Announcement $id){
        return response()->json(['success' => true, 'message' => 'Announcement Details','data' => $id ]);

    }

    public function updateAnnouncement(Announcement $id){
        request()->validate([
            'announcement_title' => ['required', 'string', 'max:255'],
            'announcement_description' => ['required', 'string'],
            'announcement_type' => ['required', 'string', 'max:255'],
            'announcement_links' => ['string', 'max:255','nullable'],
        ], [], 
        [
            // Change field names to =>
            'announcement_title' => 'title',
            'announcement_description' => 'description',
            'announcement_type' => 'type',
            'announcement_links' => 'links',
        ]);
            $id->announcement_title = request()->announcement_title;
            $id->announcement_description = request()->announcement_description;
            $id->announcement_type = request()->announcement_type;
            $id->announcement_links = request()->announcement_links;
            $id->save();
    
        return response()->json(['success' => true,'message'=>'Account updated!','data' => $id]);
    }
    public function deleteAnnouncement(Announcement $id){
        
        $image_path = public_path('storage').'/'.$id->announcement_image;
        unlink($image_path);
        $id->delete();
        return response()->json(['success' => 'Announcement deleted!']);
    
    }


    // GALLERY
    public function gallery(){
        // $sliders = [];
        if(request()->ajax()){
            $galleries = Gallery::latest()->get();
            return Datatables::of($galleries)
                ->addIndexColumn()
                ->addColumn('gallery_image', function ($row) {
                    return '<img src="'.url('storage/'.$row->gallery_image).'" border="0" width="40" class="rounded" align="center" />';
                })
                ->addColumn('action', function($row){
                    $button = '<a href="'.url('admin/galleries/edit')."/".$row->gallery_id.'" id="editGallery" class="btn btn-sm p-1 mx-1 rounded-circle bg-dark text-light" name="edit" data-id="'.$row->gallery_id.'" data-image="'.url('storage/'.$row->gallery_image).'"><span class="material-symbols-outlined rotate">settings</span></a>';
                    // $button .= '<a href="'.url('admin/galleries/delete')."/".$row->gallery_id.'" id="deleteGallery" class="btn btn-sm p-1 mx-1 rounded-circle light-danger text-light " name="delete" data-id="'.$row->gallery_id.'"><span class="material-symbols-outlined">delete</span></a>';
                    return $button;
                    
                })
                ->rawColumns(['gallery_image','action'])
                ->make(true);
        }
        return view('management.admin.gallery');
    }




    public function storeGallery(){
        request()->validate([
            'gallery_title' => 'required|string|max:255',
            'gallery_participants' => 'string|nullable',
            'gallery_image' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'gallery_type' => 'required|string',
            'gallery_date' => 'required|date',
        ]);

        $image_path = request()->file('gallery_image')->store('images/gallery', 'public');

        Gallery::create([
            'gallery_title' => request()->gallery_title,
            'gallery_participants' => request()->gallery_participants,
            'gallery_image' => $image_path,
            'gallery_type' => request()->gallery_type,
            'gallery_date' => request()->gallery_date,
        ]);

        // dd($request->announcement_image);
        return response()->json(['success'=>'Photo added!']);
    }

    public function editGallery(Gallery $id){
        return response()->json(['success' => true, 'message' => 'Photo Details','data' => $id ]);

    }

    public function updateGallery(Gallery $id){
        request()->validate([
            'gallery_title' => ['required', 'string', 'max:255'],
            'gallery_participants' => ['string', 'max:255', 'nullable'],
            'gallery_type' => ['required', 'string', 'max:255'],
            'gallery_date' => ['required','date'],
        ], [], 
        [
            // Change field names to =>
            'gallery_title' => 'title',
            'gallery_participants' => 'participants',
            'gallery_type' => 'type',
            'gallery_date' => 'date',
        ]);
            $id->gallery_title = request()->gallery_title;
            $id->gallery_participants = request()->gallery_participants;
            $id->gallery_type = request()->gallery_type;
            $id->gallery_date = request()->gallery_date;
            $id->save();
    
        return response()->json(['success' => true,'message'=>'Photo updated!','data' => $id]);
    }

    public function viewGallery(Gallery $id){
        return response()->json($id);
    }

    public function deleteGallery(Gallery $id){
        
        $image_path = public_path('storage').'/'.$id->gallery_image;
        unlink($image_path);
        $id->delete();
        return response()->json(['success' => 'Photo deleted!']);
    
    }

//END 
}
