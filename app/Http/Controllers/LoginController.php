<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Hash;

class LoginController extends Controller{
    
    public function authenticate(Request $request){
    
        if (Auth::attempt(['email'=> $request->email,'password'=>$request->password,'active'=> 1])){
            return redirect('/');
        }else{
            return redirect()->back()->with('failed'
            ,'Login Gagal !! , Akun anda belum terdaftar pada sistem kami');
        }
    }
    public function register_in(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        Mail::to($user->email)->send(new VerifyEmail($user));

        return redirect()->back()->with('sukses'
        ,'Terima kasih telah melakukan pendaftaran, Selanjutnya silakan 
        aktivasi akun, cek di Inbox atau di Spam email Anda.');
    }
}