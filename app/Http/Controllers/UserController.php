<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Users';
        $level = Level::all();
        return view('pages.users', compact('level','title'))->with([
            'user' => User::with('level')->get()->sortBy('level_id'),
        ]);

    }

    public function create()
    {
        $level = Level::all();
        return view('pages.tambah_user', compact('level'))->with([
            'user' => User::with('level')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,',
            'email' => 'required|email|unique:users,email,',
            'no_hp' => 'required|min:10|',
            'level_id' => 'required',
            'password' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->level_id = $request->level_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return to_route('users.index')->with('Success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $level = level::all();
        return view('pages.edit_user', compact('level'))->with([
            'user' => User::find($id),
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'no_hp' => 'required|min:10|',
            'level_id' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->level_id = $request->level_id;
        $user->save();

        return to_route('users.index')->with('Success.', 'Data Berhasil Diedit ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $user = User::find($id);
        $user->delete();


        return back()->with('Success','Berhasil Hapus Data');
    }


}
