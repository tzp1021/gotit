<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create() {
        return view('sessions.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($credentials)) {
            return redirect()->route('edit');
        } else {
            session()->flash('danger', 'Please check the user and password.');
            return redirect()->back();
        }

        return;
    }

    public function destroy() {
        Auth::logout();
        session()->flash('success', 'Logout succeed！');
        return redirect('login');
    }
}
