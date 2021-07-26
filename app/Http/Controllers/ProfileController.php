<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|required_with:new_password|same:new_password'
        ]);


        $user = User::findOrFail(Auth::user()->id);
        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        session()->flush('success', 'Profile updated successfully');
        if (isset($data['current_password'])) {
            if (Hash::check($data['current_password'], $user->password)) {
                $new_password = Hash::make($data['new_password']);
            } else {
                session()->flush('error', 'Current password didnt match');
            }
        }
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  isset($new_password) ? $new_password : $user->password,
        ]);
        return redirect(route('profile'));
    }
}
