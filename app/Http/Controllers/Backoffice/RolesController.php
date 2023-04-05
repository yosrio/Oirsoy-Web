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

class RolesController extends \App\Http\Controllers\Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        $roles = Roles::all();
        return view('backoffice.roles.index', ['roles' => $roles]);
    }

    public function addOrUpdate($id = null)
    {
        if (!Auth::check()) {
            return view('auth.login');
        }

        if ($id != null) {
            $roleSelected = Roles::find($id);
            return view('backoffice.roles.edit', ['roleSelected' => $roleSelected]);
        }

        return view('backoffice.roles.edit');
    }

    public function save(Request $request)
    {
        $sidebar = Sidebar::get();
        $user = Auth::user();
        $totalMenuSidebar = 0;
        foreach ($sidebar as $menu) {
            $menuItems = json_decode($menu->item, 1);
            $totalMenuSidebar += count($menuItems['items']);
        }

        $menuList = array_filter($request->menu_list, 'strlen');
        $totalRolesMenu = count($menuList);
        
        $result = [];
        foreach ($menuList as $value) {
            $array = explode("_", $value);
            if (array_key_exists($array[0],$result)) {
                array_push($result[$array[0]], $array[1]);
            } else {
                $result[$array[0]] = array($array[1]);
            }
        }
        $result = json_encode($result);
        
        if ($request->id) {
            $roles = Roles::find($request->id);
            $roles->name = $request->name;
            $roles->permission = $result;
        } else {
            $roles = new Roles;
            $roles->name = $request->name;
            $roles->permission = $result;
        }
        $roles->save();

        $roles = Roles::all();
        return view('backoffice.roles.index', ['roles' => $roles]);
    }

    public function delete($id)
    {
        $roles = Roles::find($id);

        if ($roles->delete()) {
            return redirect(route('roles'))->with('success', 'Successfully delete roles.');
        }

        return redirect(route('roles'))->with('error', 'Failed delete roles.');
    }
}
