<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $formData=request()->validate([
            'name'=>['required','max:255','min:3'],
            'email'=>['required','email',Rule::unique('users','email')],
            'username'=>['required','max:255','min:3',Rule::unique('users','username')],
            'password'=>['required','min:8'],
        ]);

        // $formData['password']=bcrypt($formData['password']);
        
        $user=User::create($formData);

        auth()->login($user);

        // session()->flash('success','Welcome Dear, '.$user->name);
        return redirect('/')->with('success','Welcome Dear, '.$user->name); 
    }

    public function login()
    {
        return view('auth.login');
    }

    public function post_login()
    {
        $formData=request()->validate([
            'email'=>['required','email','max:255',Rule::exists('users','email')],
            'password'=>['required','min:8','max:255']
        ],[
            'email.required'=>'We need your email address.',
            'password.min'=>'Password should be more than 8 characters.'
        ]);
        
        //if user credentials correct -> redirect home
        if(auth()->attempt($formData))
        {
            if(auth()->user()->is_admin)
            {
                return redirect('/admin/blogs');
            }else{
                return redirect('/')->with('success','Welcome Back!');
            }
        }else{
            //if user credentials fail -> redirect back to form with error
            return redirect()->back()->withErrors([
                'email'=>'User credentials wrong.'
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success','Good Bye!'); 
    }

}
