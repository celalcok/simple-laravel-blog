<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(){
        return \view('back.auth.login');
    }
    public function loginPost(Request $request){
        // dd($request->post());
        $auth=Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        if($auth){
            toastr()->success('Tekrardan hoşgeldiniz <br>',Auth::user()->name);
            return redirect(route('admin.dashboard'));
        }
        return redirect(route('admin.login'))->withErrors('Email adresi veya şifre hatalı');
    }
    public function logout(){
      Auth::logout();

        return redirect(route('admin.login'));
    }

}
