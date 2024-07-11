<?php

namespace App\Http\Controllers;

use App\Models\CandidateModel;
use App\Models\ResponseModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $data['getUsers'] = User::getUsers();
        $data['getCandidates'] = CandidateModel::getCandidates();
        
       
        return view('admin.dashboard',$data);
    }
    public function adminadd(){
        return view('admin.admin.add');
    }

    ///view all admins
    public function adminlist(){
        $data['getRecord'] = User::getAdmin();
        return view('admin.admin.list',$data);
    }

    //admin edit route visit
    public function adminedit($id){
        $data['getRecord'] = User::getSingle($id);
        return view('admin.admin.edit',$data);
    }

    public function addadmin(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request->all());
        $user = new User;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        if(!empty($request->profile_pic)){
            $imageName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('images'), $imageName);
            // $user->profile_pic = trim($request->profile_pic);
            $user->profile_pic = 'images/'.$imageName;
        }
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->user_type = 1;
        $user->save();


        return redirect('admin/admin/list')->with('success','admin added successfully');


    }


    public function updateadmin($id, Request $request){
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        if(!empty($request->profile_pic)){
            $imageName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('images'), $imageName);
            // $user->profile_pic = trim($request->profile_pic);
            $user->profile_pic = 'images/'.$imageName;
        }
        $user->user_type = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success','admin Updated successfully');
    }


    public function deleteadmin($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success','admin Deleted successfully');

    }
}
