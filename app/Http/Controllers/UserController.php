<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        if(!Auth::check()){
            return view('auth.login');
        }

        $user = Auth::user();
        $users = User::all();
        return view('backoffice.users.index', ['user' => $user, 'users' => $users]);
    }
    public function addUser($id = null)
    {
        if(!Auth::check()){
            return view('auth.login');
        }

        if ($id != null) {
            $userSelected = User::find($id);
            return view('backoffice.users.edit', ['userSelected' => $userSelected]);
        }

        $user = Auth::user();
        return view('backoffice.users.edit', ['user' => $user]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',  
            'newPassword' => 'required',
            'confirmNewPassword' => 'required_with:newPassword|same:newPassword'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->id) {
            $user = User::find($request->id);
        } else {
            $user = new User;
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->newPassword);

        try {
            if ($user->save()) {
                return redirect(route('users'))->with('success', 'Successfully Add User.');
            }
        } catch (\Throwable $th) {
            return redirect(route('user.add'))->with('error', 'Something went wrong. Failed to add user!');
        }
    }
}
?>