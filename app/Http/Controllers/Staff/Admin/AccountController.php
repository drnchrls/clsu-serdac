<?php

namespace App\Http\Controllers\Staff\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivUser;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
class AccountController extends Controller
{

    
////////////////////////// CRUD - STAFF
public function staff(Request $request){
    $users = [];
    if($request->ajax()){
        $users = Staff::latest()->where('staff_id','!=','1')->get();
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $button = '<a href="'.url('admin/staffs/edit')."/".$row->staff_id.'" id="editStaff" class="btn btn-sm p-1 mx-1 rounded-circle bg-dark text-light" name="edit" data-id="'.$row->staff_id.'"><span class="material-symbols-outlined rotate">settings</span></a>';
                // $button = '<a href="'.url('admin/staffs/delete')."/".$row->staff_id.'" id="deleteStaff" class="btn btn-sm p-1 mx-1 rounded-circle light-danger text-light " name="delete" data-id="'.$row->staff_id.'"><span class="material-symbols-outlined">delete</span></a>';
                return $button;
                
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    return view('management.admin.staff_acc', compact('users'));
}
public function storeStaff(Request $request){

    $request->validate([
        'staff_fname' => ['required', 'string', 'max:255'],
        'staff_lname' => ['required', 'string', 'max:255'],
        'staff_email' => ['required', 'email', 'max:255', 'unique:staffs,staff_email'],
        'staff_password' => ['required', 'min:8', 'max:30'],
        'staff_confirmation_password' => ['required','same:staff_password'],
        'staff_role' => ['required', 'string'],
        'staff_contact' => ['required','string', 'max:30'],
    ], [], 
    [
        // Change field names to =>
        'staff_fname' => 'first name',
        'staff_lname' => 'last name',
        'staff_email' => 'email',
        'staff_password'=> 'password',
        'staff_confirmation_password' => 'confirmation password',
        'staff_role'=> 'role',
        'staff_contact'=> 'contact',
    ]);

    Staff::create(
    [
        'staff_fname' => $request->staff_fname,
        'staff_lname' => $request->staff_lname,
        'staff_email' => $request->staff_email,
        'staff_password' => Hash::make($request->staff_password),
        'staff_role' => $request->staff_role,
        'email_verified_at' => now(),
        'staff_contact' => $request->staff_contact,
    ]);
    return response()->json(['success'=>'Account created!']);
}


public function editStaff(Staff $id){
    return response()->json(['success' => true, 'message' => 'Account Details','data' => $id ]);

}

public function updateStaff(Request $request, Staff $id){

    $request->validate([
        'staff_fname' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z]+$/'],
        'staff_lname' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z]+$/'],
        'staff_role' => ['required', 'string'],
        'staff_contact' => ['required', 'string', 'max:30'],
    ], [], 
    [
        // Change field names to =>
        'staff_fname' => 'first name',
        'staff_lname' => 'last name',
        'staff_role'=> 'role',
        'staff_contact'=> 'contact',
    ]);
        $id->staff_fname = $request->staff_fname;
        $id->staff_lname = $request->staff_lname;
        $id->staff_role = $request->staff_role;
        $id->staff_contact = $request->staff_contact;
        $id->save();

    // $user->update([
    //     'staff_fname' => $request->staff_fname,
    //     'staff_lname' => $request->staff_lname,
    //     'staff_role' => $request->staff_role,
    //     'staff_contact' => $request->staff_contact,
    // ]);

    return response()->json(['success' => true,'message'=>'Account updated!','data' => $id]);
    
}


public function deleteStaff(Request $request){

    $privuser = Staff::where('staff_id', $request->id)->delete();
    return response()->json(['success' => 'Account deleted!']);

}


// public function storeStaff(){
//     $data = request()->validate([
//         'staff_fname' => ['required', 'string', 'max:255'],
//         'staff_lname' => ['required', 'string', 'max:255'],
//         'staff_email' => ['required', 'email', 'max:255', 'unique:users,email'],
//         'staff_password' => ['required' ,'min:8'],
//         'staff_cpassword' => ['required','min:8','same:staff_password'],
//         'staff_role' => ['required', 'string'],
//         'staff_contact' => ['required','string'],
//     ]);

//     PrivUser::create($data);
//     // return redirect()->route('admin.add.staffs')->with('success', 'Account successfully created!');
    
//     return response()->json(['success'=>'Account created!']);
// }

// public function editStaff(PrivUser $id){

//     return view('dashboard.priv.admin.staffs.edit-privuser',[
//         'user' => $id
//     ]);
// }

// public function updateStaff(PrivUser $id){
//     $data = request()->validate([
//         'staff_fname' => [ 'string', 'max:255'],
//         'staff_lname' => [ 'string', 'max:255'],
//         'staff_email' => [ 'email', 'max:255'],
//         // 'password' => ['required' ,'min:8'],
//         // 'cpassword' => ['required','min:8','same:password'],
//         'staff_role' => [ 'string'],
//         'staff_contact' => ['string'],
//     ]);
//     $id->update($data);
//     // return back()->with('updated', 'Account successfully updated!');
//     return response()->json(['success'=>'Account updated!']);
    
// }

// public function deleteStaff(PrivUser $id){
//     $id -> delete();
//     // return redirect()->route('admin.staffs')->with('deleted', 'Account successfully deleted!');
//     return response()->json(['success' => 'Account deleted!']);
// }

////////////////////////////////////////////////////////////////////////////////////////////////////////




////////////////////////// CRUD - USER

public function user(Request $request){
    if($request->ajax()){
        $users = User::latest()->get();
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                // $button = '<a href="'.url('admin/users/view')."/".$row->id.'" id="viewUser" class="btn btn-info btn-sm p-1 mx-1 rounded-circle text-light" name="view" data-id="'.$row->id.'"><span class="material-symbols-outlined">visibility</span></a>';
                $button = '<a href="'.url('admin/users/edit')."/".$row->id.'" id="editUser" class="btn btn-sm p-1 mx-1 rounded-circle bg-dark text-light" name="edit" data-id="'.$row->id.'"><span class="material-symbols-outlined rotate">settings</span></a>';
                // $button .= '<a href="'.url('admin/users/delete')."/".$row->id.'" id="deleteUser" class="btn btn-sm p-1 mx-1 rounded-circle light-danger text-light" name="delete" data-id="'.$row->id.'"><span class="material-symbols-outlined">delete</span></a>';
                return $button;
    
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    return view('management.admin.auth_acc');
}

public function viewUser(User $id){
  
    return response()->json($id);
}
// public function viewUser(Request $request){
//     $where = array('id' => $request->id);
//     $user  = User::where($where)->first();
  
//     return response()->json($user);
// }

public function editUser(User $id){
    return response()->json(['success' => true, 'message' => 'Account Details','data' => $id ]);

}

public function updateUser(Request $request, User $id){

    $request->validate([
        'fname' => ['string', 'max:255'],
        'lname' => ['string', 'max:255'],
        'contact' => ['string', 'max:30'],
        'occupation' => ['string', 'max:255'],
        'age' => ['max:3'],
        'educational_level' => ['string', 'max:255'],
        'address' => ['string', 'max:255'],
    ], [], 
    [
        // Change field names to =>
        'fname' => 'first name',
        'lname' => 'last name',
        'email' => 'email',
        'password'=> 'password',
        'occupation'=> 'occupation',
        'contact'=> 'contact',
        'age' => 'age',
        'educational_level' => 'educational level',
    ]);
        $id->fname = $request->fname;
        $id->lname = $request->lname;
        $id->contact = $request->contact;
        $id->occupation = $request->occupation;
        $id->age = $request->age;
        $id->educational_level = $request->educational_level;
        $id->address = $request->address;
        
        $id->save();

        
    // $user->update([
    //     'fname' => $request->fname,
    //     'lname' => $request->lname,
    //     'gender' => $request->gender,
    //     'contact' => $request->contact,
    // ]);

    return response()->json(['success' => true,'message'=>'Account updated!','data' => $id]);
    
}

public function deleteUser(Request $request){

    $user = User::where('id', $request->id)->delete();
    return response()->json(['success' => 'Account deleted!']);

}

// public function showUser(){
//     $users = User::latest()->get();
//     return Datatables::of($users)
//         ->addIndexColumn()
//         ->addColumn('action', function($users){
//             $actionBtn = '<a href="'.url('/admin/users/'.$users->id).'" class="edit btn btn-primary btn-sm" id=>View</a>
//                          <a href="#" class="delete btn btn-danger btn-sm" id=>Delete</a>
//                          ';
//             return $actionBtn;

//         })
//         ->rawColumns(['action'])
//         ->make(true);
// }




    // public function user(){
    //     $users = User::simplePaginate(8);
    //                     // ->get();

    //     return view('dashboard.priv.admin.users.user-accounts', [
    //             'users'=> $users
    //     ]);


    // }

    // public function editUser(User $id){
    //     return view('dashboard.priv.admin.users.edit-user',[
    //         'user' => $id
    //     ]);
    // }

    // public function updateUser(User $id){
    //     $data = request()->validate([
    //         'fname' => ['string', 'max:255'],
    //         'lname' => ['string', 'max:255'],
    //         'email' => ['email', 'max:255'],
    //         // 'password' => ['required' ,'min:8'],
    //         // 'cpassword' => ['required','min:8','same:password'],
    //         'gender' => ['string'],
    //         'contact' => ['string'],
    //         'occupation' => ['string', 'max:255'],
    //         'age' => ['integer'],
    //         'educational_level' => ['string', 'max:255'],
    //         'address' => ['string', 'max:255'],
    //     ]);
    //     $id->update($data);
    //     return back()->with('updated', 'Account successfully updated!');
    // }

    // public function deleteUser(Request $request){

    //     $user = User::where('id', $request->id)->delete();
    //     return response()->json(['success' => 'Account deleted!']);
    
    // }
////////////////////////////////////////////////////////////////////////////////////////////////////////
















}
