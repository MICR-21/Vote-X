<?php

namespace App\Http\Controllers;

use App\Models\CandidateModel;
use App\Models\ElectionModel; // Ensure you have an ElectionModel
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //
    public function viewdashboard(){
        $data['getUsers'] = User::getUsers();
        $data['getCandidates'] = CandidateModel::getCandidates();
        return view('admin.dashboard',$data);
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
        $data['getElections'] = ElectionModel::all();
        $data['getCandidates'] = CandidateModel::where('election_id', $id)->get(); // Fixed 'election' to 'election_id'
        $data['selectedElection'] = ElectionModel::find($id);
        return view('user.dashboard', $data);
    }
    public function uservote($id){
        $data['getRecord'] = CandidateModel::getSingle($id);
        return view('user.voting.vote',$data);
    }

    public function createaccount(){
        return view('auth.register');
    }

    public function login(){
        //checks if any user is logged in
        if(!empty(Auth::check())){
            if(Auth::user()->user_type == 1){
                return redirect('/admin/dashboard');
            }
            else if(Auth::user()->user_type == 2){
                return redirect('/user/dashboard');
            }
        }
        else{
            return view('auth.login');
        }
    }


    //handle user log in
    public function AuthLogin(Request $request){
        if(!empty(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))){
            //check user type before redirecting to a certain page
            if(Auth::user()->user_type == 1){
                return redirect('/admin/dashboard');
            }
            else if(Auth::user()->user_type == 2){
                return redirect('/user/dashboard');
            }
        }
        else{
            return redirect()->back()->with('error','Incorrect Login Credentials');
        }
    }


    //create a user account
    public function adduser(Request $request)
    {
        // dd($request->all());

        $user = new User();
        $user->name = trim($request->name);
        // $request->validate([
        //     'name' => 'required',
        // 'email' => 'required|email|unique:users,email',
        // 'voter_id' => 'required|unique:users,voter_id',
        // ]);

        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->voter_id = trim($request->voter_id);
        $user->user_type = 2;
        $user->save();
        // event(new Registered($user));

        // Send email to admin
        // Mail::to('admin@nexus.com')->send(new NewUserNotification($user));


        return redirect('/')->with('success', 'new user added successfully');
    }

    public function logout(){
        Auth::logout();
        return redirect(url('/'));  //Redirect to login page with success message
    }

    public function forgotpassword(){
        return view('auth.forgot');
    }

    public function PostForgotPassword(Request $request){
        // dd($request->all());

        $user = User::getEmailSingle($request->email);
        // dd($getEmailSingle);
        if(!empty($user)){
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPassword($user));

            return redirect()->back()->with('success','Please check you email and reset your password');
        }else{
            return redirect()->back()->with('error',"Email not found");
        }

    }

    public function reset($remember_token){
        $user = User::getTokenSingle($remember_token);
        // dd($remember_token);

        if(!empty($user)){
            $data['user'] = $user;
            return view('auth.reset',$data);

        }else{
            abort(404);
        }
    }


    public function PostReset($remember_token, Request $request){
        if($request->password == $request->cpassword){
            $user = User::getTokenSingle($remember_token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect('')->with('success','passwordreset successfully');


        }else{
            return redirect()->back()->with('error','Password not match');
        }

    }
}
