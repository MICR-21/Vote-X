<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;

class LockScreen extends Controller
{
    public function lockScreen(Request $request)
    {
        User::where('id', $request->user()->id)->update(['isLocked' => 1]);
        Auth::logout();
        return view('auth.lockscreen');
    }

    public function unlock(Request $request)
    {

        $request->validate([
            'password' => 'required|string',
        ]);

        $user = User::find($request->user()->id);
        $check = Hash::check($request->input('password'), $user->password);

        if (!$check) {
            // echo "Fail, your password does not match", "Error";
            return redirect()->route('lock_screen');
        }
        session(['lock-expires-at'=>now()->addMinutes($request->user()->getLockoutTime())]);
        return redirect('dashboard');
    }

}

}
