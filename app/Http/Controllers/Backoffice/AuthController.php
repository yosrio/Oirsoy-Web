<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends \App\Http\Controllers\Controller
{

    public function index()
    {
        if(Auth::check()){
            return redirect(route('dashboard'));
        }
        return view('auth.login');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('backoffice.dashboard.index');
        }
   
        return redirect(route("login"))->withSuccess('You are not allowed to access');
    }
    
    public function register()
    {
        return view('auth.register');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'))
                        ->withSuccess('Signed in');
        }
        
        return redirect(route("login"))->withSuccess('Login details are not valid');
    }

    public function customRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect(route("dashboard"))->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function logOut() {
        Session::flush();
        Auth::logout();

        return Redirect(route('login'));
    }
}
?>