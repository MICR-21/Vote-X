<?php
namespace App\Http\Controllers;

use App\Models\CandidateModel;
use App\Models\ElectionModel;
use App\Models\ResponseModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function dashboard()
    {
        // Create an instance of SmartContractController
        $smartContractController = new SmartContractController();

        // Fetch the contract address and ABI from SmartContractController
        $contractAddress = $smartContractController->getContractAddress();
        $abi = $smartContractController->getAbi();

        // Log debug information
        Log::debug('Contract Address: ' . $contractAddress);
        Log::debug('ABI: ' . json_encode($abi));

        // Fetch other data
        $totalElections = ElectionModel::count();
        $totalCandidates = CandidateModel::count();

        // Pass all data to the view
        return view('admin.dashboard', [
            'contractAddress' => $contractAddress,
            'abi' => $abi,
            'totalElections' => $totalElections,
            'totalCandidates' => $totalCandidates,
        ]);
    }

    public function adminadd()
    {
        return view('admin.admin.add');
    }

    public function adminlist()
    {
        $data['getRecord'] = User::getAdmin();
        return view('admin.admin.list', $data);
    }

    public function adminedit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        return view('admin.admin.edit', $data);
    }

    public function addadmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new User;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if (!empty($request->profile_pic)) {
            $imageName = time() . '.' . $request->profile_pic->extension();
            $request->profile_pic->move(public_path('images'), $imageName);
            $user->profile_pic = 'images/' . $imageName;
        }
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->user_type = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', 'admin added successfully');
    }

    public function updateadmin($id, Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if (!empty($request->profile_pic)) {
            $imageName = time() . '.' . $request->profile_pic->extension();
            $request->profile_pic->move(public_path('images'), $imageName);
            $user->profile_pic = 'images/' . $imageName;
        }
        $user->user_type = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', 'admin updated successfully');
    }

    public function deleteadmin($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', 'admin deleted successfully');
    }
}

