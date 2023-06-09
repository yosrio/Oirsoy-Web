<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Roles;
use App\Models\Sidebar;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends \App\Http\Controllers\Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        $users = User::all();
        return view('backoffice.users.index', ['users' => $users]);
    }
    public function addOrUpdate($id = null)
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        $roles = Roles::all();
        if ($id != null) {
            $userSelected = User::find($id);
            return view('backoffice.users.edit', [
                'userSelected' => $userSelected,
                'roles' => $roles
            ]);
        }

        return view('backoffice.users.edit', ['roles' => $roles]);
    }

    public function save(Request $request)
    {
        $successMessage = '';
        $failedMessage = '';
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->id) {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $validator = Validator::make($request->all(), [
                    'password' => [
                        'min:8',
                        'max:64',
                        'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,64}$/'
                    ]
                ]);
    
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $user->password = Hash::make($request->password);
            }
            $successMessage = 'Successfully Update User.';
            $failedMessage = 'Something went wrong. Failed to update user!';
        } else {
            $user = new User;

            $validator = Validator::make($request->all(), [
                'password' => [
                    'required',
                    'min:8',
                    'max:64',
                    'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,64}$/'
                ],
                'email' => 'required|email:rfc,dns|unique:users,email',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $successMessage = 'Successfully Add User.';
            $failedMessage = 'Something went wrong. Failed to add user!';
        }

        $roles = Roles::find($request->role_id);
        $user->role_id = $roles->id;

        try {
            if ($user->save()) {
                return redirect(route('users'))->with('success', $successMessage);
            }
        } catch (\Throwable $th) {
            return redirect(route('user.add'))->with('error', $failedMessage);
        }
    }

    public function delete($id)
    {
        $loggedUser = Auth::user();
        $user = User::find($id);

        if ($loggedUser->id == $user->id) {
            return redirect(route('users'))->with('error', 'Cannot delete the user you are currently using!');
        }

        if ($user->delete()) {
            return redirect(route('users'))->with('success', 'Successfully delete user.');
        }

        return redirect(route('users'))->with('error', 'Failed delete user.');
    }
}
