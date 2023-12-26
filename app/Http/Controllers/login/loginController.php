<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Models\Password_reset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Nette\Utils\Random;
use App\Mail\resetPassword;
class loginController extends Controller
{
    public function login(Request $request){

        if($request->isMethod('post')){

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            if(auth()->attempt(['email' =>$request->email, 'password'=>$request->password])){
                $user = Auth::user();
                if($user){
                    return redirect('admin/dashboard');
                }
            }else{
                    return redirect('admin/login')->withErrors('User not found');
            }
        }
        return view('admin/login');
    }

    public function logout(Request $request){

        Auth::logout();
        return redirect('admin/login');
    }

    public function forgetPassword(Request $request){

        if($request->isMethod('post')){

            $request->validate([
                'email' => 'required|email'
            ]);

            $user = User::where('email',$request->email)->first();


            $token = Str::random(64);
            Password_reset::insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            
            if($user){
                Mail::to($user->email)->send(new resetPassword(['user' =>$user->name, 'token' =>$token]));
                return back()->withErrors('Check out your email inbox');
                
            }else{
                return back()->withErrors('Email Id not found!');

            }  
        }
         
        
        return view('admin.forgetPassword');
    }
}
