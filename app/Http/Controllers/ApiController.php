<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
    public function index()
    {
        $title = 'Api Keys';
        return view('pages.api_keys', compact('title'))->with([
            'user' => User::all(),
        ]); 
    }

    public function edit($id)
    {
        $title = 'Api Keys';
        return view('pages.users.edit_endpoint', compact('title'))->with([
            'user' => User::find($id),
        ]); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'endpoint' => 'required'
        ]);

        $user = User::find($id);
        $user->endpoint = $request->endpoint;
        $user->save();

        return to_route('api.index')->with('Success.', 'Data Berhasil Diedit');
    }
}
