<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Authentication extends Controller
{
    //
    public function index(){
        return view('product.index');
    }
    public function register(){
        return view('users.register');
    }
    public function register_process(Request $request){

    $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required|min:8'
    ]);
    $user=new User();
    $user->name=$request->name;
    $user->email=$request->email;
    $user->password=Crypt::encrypt($request->password);
    $user->save();
        return redirect('/');




    }
    public function login(){
        return view('users.login');
    }
    public function login_process(Request $request){
      $user=DB::table('users')->where(['email'=>$request->email])->get();
      if (isset($user[0])){
          $dbPassword=Crypt::decrypt($user[0]->password);

      if ($dbPassword==$request->password){
          $request->session()->put('USER_LOGIN',true);
          $request->session()->put('USER_ID',$user[0]->id);
          $request->session()->put('USER_NAME',$user[0]->name);
          return redirect('index');

      }
      else{
          return redirect()->back()->with('error','please enter valid password');

      }


    }
      else{
          return redirect()->back()->with('error','please enter valid email');
      }

    }

}
