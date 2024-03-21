<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = DB::table('view_users')->get();
        return view('users.index', compact('users'));
    }   

    public function makeProvinsi(Request $request, $userId)
    {
        $user = User::findOrFail($userId); 
        $user->syncRoles('bawaslu-provinsi');
        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function makeKota(Request $request, $userId)
    {
        $user = User::findOrFail($userId); 
        $user->syncRoles('bawaslu-kota');
        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function makePanwascam(Request $request, $userId)
    {
        $user = User::findOrFail($userId); 
        $user->syncRoles('panwascam');
        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
