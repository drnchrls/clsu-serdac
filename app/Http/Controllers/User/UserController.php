<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\DownloadDataset;
use App\Models\DownloadPublication;
use App\Models\Publication;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\ConcernNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function concern(){
        request()->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'concern' => 'required|string',
        ]);
        $email = request()->email;
        $name = request()->name;
        $phone = request()->phone;
        $concern = request()->concern;

        Notification::route('mail', 'esample008@gmail.com')->notify(new ConcernNotification($email, $name, $phone, $concern));
        return redirect('/#contact-us')->with('success','Submitted successfully!');
    }

    public function editProfile(){
        return view('dashboard.auth-user.profile',
            array('current_user' => Auth::user()) 
        );
    }


    public function updateProfile(User $id)
    {
        // $current_user = Auth::user();
        $data = request()->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'gender' => ['string'],
            'contact' => ['nullable', 'string'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'age' => ['nullable', 'integer'],
            'educational_level' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
        ],[],
        [
            'fname' => 'first name',
            'lname' => 'last name',
            'educational_level' => 'educational level',
        ]);

      
        // Update user
        $id->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }


    public function updatePassword()
    {
            # Validation
            request()->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);
    
    
            #Match The Old Password
            if(!Hash::check(request()->old_password, auth()->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }
    
    
            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make(request()->new_password)
            ]);
    
            return back()->with("status", "Password changed successfully!");
    }
    
    public function downloadHistory(){
        $id = Auth::guard('web')->user()->id;

        $downloadPublications = DownloadPublication::with('user')->where('download_user_id', $id)->latest()->get();
        $downloadDatasets = DownloadDataset::with('user')->where('download_user_id', $id)->latest()->get();
        return view('dashboard.auth-user.downloads',['downloadPublications'=>$downloadPublications, 'downloadDatasets'=>$downloadDatasets]);

    }

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
