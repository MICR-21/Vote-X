<?php
namespace App\Http\Controllers;

use App\Models\CandidateModel;
use App\Models\ElectionModel;
use App\Models\User;
use App\Models\VotesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    public function candidatelist(){
        $data['getRecord'] = CandidateModel::getCandidates();
        return view('admin.candidate.list', $data);
    }

    public function addcandidateroute(){
        $data['getElections'] = ElectionModel::getElections();
        return view('admin.candidate.add', $data);
    }

    public function candidateedit($id){
        $data['getRecord'] = CandidateModel::getSingle($id);
        $data['getElections'] = ElectionModel::getElections();
        return view('admin.candidate.edit', $data);
    }

    public function candidatevotes($id){
        $data['getRecord'] = VotesModel::getMyVotes($id);
        return view('admin.candidate.votes', $data);
    }

    public function addcandidate(Request $request)
    {
        $user = new CandidateModel();
        $user->name = trim($request->name);
        $user->email = trim($request->email);

        if(!empty($request->profile_pic)){
            $imageName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('images'), $imageName);
            $user->profile_pic = 'images/'.$imageName;
        }
        $user->contact = trim($request->contact);
        $user->election = trim($request->election);
        $user->save();

        return redirect('admin/candidate/list')->with('success', 'New candidate added successfully');
    }

    public function updatecandidate($id, Request $request){
        $request->validate([
            'email' => 'required|email|unique:candidates,email,'.$id
        ]);

        $user = CandidateModel::getSingle($id);
        if ($user) {
            $user->name = trim($request->name);
            $user->email = trim($request->email);

            if(!empty($request->profile_pic)){
                $imageName = time().'.'.$request->profile_pic->extension();
                $request->profile_pic->move(public_path('images'), $imageName);
                $user->profile_pic = 'images/'.$imageName;
            }
            $user->contact = trim($request->contact);
            $user->election = trim($request->election); // Ensure election field is updated if necessary

            $user->save();

            return redirect('admin/candidate/list')->with('success','Candidate Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Candidate not found.');
        }
    }


    public function deletecandidate($id){
        $user = CandidateModel::getSingle($id);

        if($user) {
            $user->is_delete = 1;
            $user->save();
            return redirect('admin/candidate/list')->with('success', 'Candidate deleted successfully');
        } else {
            return redirect('admin/candidate/list')->with('error', 'Candidate not found');
        }
    }
}
