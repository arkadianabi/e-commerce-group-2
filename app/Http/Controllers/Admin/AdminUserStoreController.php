<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserStoreController extends Controller
{
    public function index()
    {
        $users = User::all();
        $stores = Store::all();
        return view('admin.user-store-management', compact('users', 'stores'));
    }
}

