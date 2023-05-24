<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index(Request $request){

        $title = 'Profile';
        $level = Level::all();
        return view('pages.users.profil', compact('level', 'title'))->with([
            'user' => user::all()
        ]);
    }

    public function edit(Request $request, $id)
    {

        $title = 'Edit Password';
        return view('pages.users.edit_password', compact('title'))->with([
            'user' => User::find($id),
        ]); 

        $request->validate([
            'password' => 'required',
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return to_route('profil.index')->with('Success.', 'Data Berhasil Diedit ');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'password' => 'required',
        ]);

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        // DB::table('users')->where('id',$request->id)->update([
        //     'password' => Hash::make($request->password)
        // ]);

        return to_route('profil.index')->with('Success.', 'Data Berhasil DiUpdate');
    }

}
