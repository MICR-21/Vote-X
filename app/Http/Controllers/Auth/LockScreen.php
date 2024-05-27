<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
Use session;
use Charles\Msg\Facades\Msg;

class LockScreen extends Controller
{
    public function lockScreen()
    {
        if(session('lock-expires-at'))
        {
            return redirect('/');
        }
        if(session('lock-expires-at')> now())
        {
            return redirect('/');
        }
        return view('auth.lockscreen');
    }
    //unlock screen
    public function unlock(Request $request)
    {
        $request->validate
        ([
            'password'=> 'required|string',
        ]);
        $check=Hash::check
        (
            $request->input('password'),$request->user()->password
        );
        if(!$check)
        {
            Msg::error('fail, Your password does not match','Error');
            return redirect()->route('lock_screen');
        }
        session(['lock-expires-at'=>now()->addMinutes($request->user()->getLockoutTime())]);
        return redirect('Dashboard');
    }

}    