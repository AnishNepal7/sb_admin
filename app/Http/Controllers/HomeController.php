<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        return view('index');

    }
    public function login()
    {
        return view('login');
        
    }
    public function auth()
    {
        request()->validate(['email'=>'required|email','password'=>'required|min:8']);
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')]))
        {
            return redirect('/');
        }
        return redirect('login')->withErrors('wrong email or password');
        
    }
    public function register()
    {
        
        return view('register');        
    }
    public function store()
    {
        request()->validate(['fname'=>'required','lname'=>'required','email'=>'required|email','password'=>'required|min:8']);
        $user = new User;
        $user->fname=request('fname');
        $user->lname=request('lname');
        $user->email=request('email');
        $user->password=request('password');
        $user->save();
        return redirect('login');

    }
    public function show()
    {
        $users=User::all();
        return view('tables',compact('users'));  
    }
}
