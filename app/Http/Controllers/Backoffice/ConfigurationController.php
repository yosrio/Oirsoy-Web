<?php
namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConfigurationController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        return view('backoffice.config.index');
    }
}
?>