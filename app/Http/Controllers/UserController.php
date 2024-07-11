<?php
namespace App\Http\Controllers;

use App\Mail\NewUserNotification;
use App\Models\CandidateModel;
use App\Models\ElectionModel; // Ensure you have an ElectionModel
use App\Models\ResponseModel;
use App\Models\User;
use App\Models\VotesModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function userlist(){
        $data['getRecord'] = User::getUsers();
        return view('admin.user.list',$data);
    }

    public function userdashboard(){
        Log::info('User dashboard accessed by user: ' . Auth::user()->id);

        try {
            $data['getElections'] = ElectionModel::all(); // Fetch all elections
            Log::info('Elections fetched successfully.', ['elections' => $data['getElections']]);
        } catch (\Exception $e) {
            Log::error('Error fetching elections: ' . $e->getMessage());
            return redirect()->back()->withErrors('Error fetching elections.');
        }

        return view('user.dashboard', $data);
    }


    public function electionCandidates($id){
        Log::info('Fetching candidates for election ID: ' . $id);

        try {
            $data['getElections'] = ElectionModel::all(); // Fetch all elections
            $data['getCandidates'] = CandidateModel::where('election', $id)->get(); // Fetch candidates for the specified election
            $data['selectedElection'] = ElectionModel::find($id); // Fetch the selected election

            Log::info('Candidates fetched successfully for election ID: ' . $id, ['candidates' => $data['getCandidates']]);
        } catch (\Exception $e) {
            Log::error('Error fetching candidates for election ID: ' . $id . ' - ' . $e->getMessage());
            return redirect()->back()->withErrors('Error fetching candidates.');
        }

        return view('user.dashboard', $data);
    }

    public function adduserroute(){
        return view('admin/user/add');
    }

    public function useredit($id){
        $data['getRecord'] = User::getSingle($id);
        return view('admin.user.edit',$data);
    }

    public function uservote($id){
        $data['getRecord'] = CandidateModel::getSingle($id);
        return view('user.voting.vote',$data);
    }

    public function adduser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new User();
        $user->name = trim($request->name);
        $imageName = time().'.'.$request->profile_pic->extension();
        $request->profile_pic->move(public_path('images'), $imageName);
        $user->profile_pic = 'images/'.$imageName;
        $user->contact = trim($request->contact);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 3;
        $user->save();

        return redirect('admin/user/list')->with('success', 'New user added successfully');
    }

    public function vote(Request $request){
        $vote = new VotesModel();
        $vote->voter_id= trim($request->voter_id);
        $vote->candidate_id= trim($request->candidate_id);
        $vote->election= trim($request->election);
        $vote->save();

        return redirect('/user/dashboard')->with('success','Your vote was saved successfully');
    }

    public function updateuser($id, Request $request){
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
            $user->profile_pic = 'images/'.$imageName;
        }
        $user->contact = trim($request->contact);
        $user->user_type = 3;
        $user->save();

        return redirect('user/dashboard')->with('success','User updated successfully');

    }

    public function deleteuser($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/user/list')->with('success','User deleted successfully');
    }
}
