<?php

namespace App\Http\Controllers;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;




class AuthController extends Controller
{
        public function home()
        {
            return view('homepage');
        }


        public function index()
        {
            return view('login');
        }


    public function login(Request $request)
    {
        $request->validate
        ([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                             ->with('message', 'Signed in!');
        }
        return redirect('/login')->with('message', 'Login details are not valid!');
    }


    public function signup()
    {
        return view('register');
    }


    public function signupsave(Request $request)
    {  
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);
            
        $data = $request->all();
        $check = $this->create($data);
          
        return redirect("login");
    }


    public function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function signOut()
    {
        session::flush();
        Auth::logout();

        return redirect('login');
    }


}
