<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SandboxController extends Controller
{

    public function index()
    {
        $title = 'Api Keys';
        return view('pages.Sandbox.api_keys', compact('title'))->with([
            'user' => User::all(),
        ]); 
    }

    public function dokumentasi()
    {
        $title = 'dokumentasi';
        return view('pages.Sandbox.dokumentasi', compact('title'));
    }
}
