<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreAdminController extends Controller
{
    public function index()
    {
        $stores = Store::where('status', 'pending')->get();
        return view('admin.store-verification', compact('stores'));
    }
}

