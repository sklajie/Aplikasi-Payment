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
        $level = Level::all();
        return view('pages.users', compact('level'))->with([
            'user' => User::with('level')->get()->sortBy('level_id'),
        ]);

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
            'name' => 'required|min:5|',
            'level_id' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->level_id = $request->level_id;
        $user->save();

        return to_route('user.index')->with('Success.', 'Data Berhasil Diedit ');
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
