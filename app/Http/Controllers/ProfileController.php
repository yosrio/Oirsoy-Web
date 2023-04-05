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

class ProfileController extends Controller
{

    public function index()
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        
        return view('backoffice.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',  
            'currentPassword' => 'required',
            'newPassword' => [
                function ($attribute, $value, $fail) {
                    if (Hash::check($value, Auth::user()->password)) {
                        $fail('New password cannot be the same as your current password.');
                    }
                },
            ],
            'confirmNewPassword' => 'required_with:newPassword|same:newPassword'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!Hash::check($request->post('currentPassword'), Auth::user()->password)) {
            return redirect()->back()->with('error', 'Current password is wrong!');
        }

        $data = User::where('id',Auth::id())->first();
        $data->name = $request->name;
        $data->email = $request->email;

        if(!empty($request->newPassword)) {
            $validator = Validator::make($request->all(), [
                'newPassword' => ['min:8','max:64','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,64}$/',
                    function ($attribute, $value, $fail) {
                        if (Hash::check($value, Auth::user()->password)) {
                            $fail('New password cannot be the same as your current password.');
                        }
                    },
                ],
                'confirmNewPassword' => 'required_with:newPassword|same:newPassword'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data->password = Hash::make($request->newPassword);
        }
        
        if($data->update()){
            return redirect()->back()->with('success', 'Success  Update Profile');
        }
    }

}
?>