<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\User;
class RegistarController extends Controller
{
    public function __construct(){

    $this->middleware('guest');
    $this->middleware('checkAge')->only('store');
    }
    public function create(){
        return view('register.create');
    }
    public function store(){
        $this->validate(request(),[
        'name'=>'required',
        'email'=>'required | email',
        'password'=>'required | min:6',
        ]);
    $user= new User();
    $user->name = request('name');
    $user->email= request('email');
    $user->password=bcrypt(request('password'));
    
    $user->save();


    auth()->login($user);

    session()->flash('message','Uspesno ste registrovani');

return redirect('/posts');
    }
}
