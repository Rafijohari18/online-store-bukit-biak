<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use Http;
use Socialite;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Donation;
use App\Models\Alamat;
use App\Models\Cart;
use App\Models\Invoice;
use Auth;
use Session;
use DB;
use Crypt;

class IndexController extends Controller
{

    public function index(Request $request)
    {
        // via http
        $api = Http::get('https://apps.bukitbiak.com/api/client?secret_key=8ISomMV9W6ziQaB6Qm6wjMMzVMbgrwvhqdCWh7Alr8yKJdtAl2iMUq3tHfmDtpJc7m0buO7OBGy92HHy');
        $data['kambing'] = $api->json();
    

        return view('frontend.index',compact('data'));
    }

    public function history()
    {
        $data['history'] = Invoice::where('user_id',Auth::user()['id'])->where('status_transaksi','sukses')->with('cart')->paginate(15);
        return view('frontend.history',compact('data'));
    }
    public function home(Request $request)
    { 
        $donations = Donation::all();
        return view('home',compact('donations'));
    }
    public function detail(Request $request, $id)
    {
       

        $api = Http::get('https://apps.bukitbiak.com/api/client?secret_key=8ISomMV9W6ziQaB6Qm6wjMMzVMbgrwvhqdCWh7Alr8yKJdtAl2iMUq3tHfmDtpJc7m0buO7OBGy92HHy');
        $rubah_json = $api->json();
        $collection = collect($rubah_json['data_kambing']);
        
        $data['kambing'] = $collection->where('id',$id)->first();
        
        return view('frontend.detail-kambing',compact('data'));

    }
    public function login()
    {
        return view('frontend.login');
    }
    
    public function verify()
    {
        if (empty(request('token'))) {
        // if token is not provided
            return redirect()->route('login');
        }

    // decrypt token as email
        $decryptedEmail = Crypt::decrypt(request('token'));

    // find user by email
        $user = User::whereEmail($decryptedEmail)->first();

        if ($user->active == '1') {
        // user is already active, do something
        }

    // otherwise change user active to "1"
        $user->active = '1';
        $user->save();

    // autologin
        Auth::loginUsingId($user->id);

        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        
            $user = Socialite::driver('google')->stateless()->user();
            

            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::loginUsingId($finduser->id);
                return redirect('/');
            } else {
                $nounik = mt_rand(100000, 999999);
                $newUser = User::create([
                    'name'                 => $user->name,
                    'google_id'            => $user->id,
                    'email'                => $user->email,
                    'password'             => encrypt('123456'),
                    
                ]);

                 Auth::login($newUser);
                 return redirect('/');

            }
        
    }

  

    public function checkoutForm(Request $request)
    {
        $data['session']    = Session::get('checkout');
        $data['provinsi']   =  Provinsi::get();
        $data['kota']       =  Kota::get();
        $data['kecamatan']  =  Kecamatan::get();
        $data['desa']       =  Desa::get();
        $data['alamat']     = Alamat::with('Provinsi')
                             ->where('user_id',Auth::user()['id'])->first();
        $data['invoice']    = Invoice::with('cart')
                              ->where('user_id',Auth::user()['id'])
                              ->orderBy('id','DESC')->first();

      
        return view('frontend.checkout',compact('data'));
    }

    public function getKota($id)
    {
        $states = DB::table("kota")
                    ->where("provinsi_id",$id)
                    ->pluck("kota","id");
        return response()->json($states);
    }

    public function getKecamatan($id)
    {
        $kecamatan = DB::table("kecamatan")
                    ->where("kota_id",$id)
                    ->pluck("kecamatan","id");
        return response()->json($kecamatan);
    }

    public function getDesa($id)
    {
        $desa = DB::table("desa")
                    ->where("kecamatan_id",$id)
                    ->pluck("desa","id");
        return response()->json($desa);
    }
    public function getCart(Request $request)
    {   
        $data['cart'] = Cart::where('user_id',Auth::user()['id'])
                        ->where('status',0)->get();
        
        return view('frontend.getCart',compact('data'));
    }
    public function delete(Request $request)
    {
       $data =  Cart::where('id',$request->id)->delete();
       $success = true;
       $message = "Keranjang Berhasil di Hapus";
       
       return Response::json(
           [
               'success' => $success,
               'message' => $message,
               'data'    => $data,
       ]);
    }

    public function deleteAll(Request $request)
    {
        $data =  Cart::where('user_id',$request->user_id)->delete();
        $success = true;
        $message = "Keranjang Berhasil di Kosongkan";
       
       return Response::json(
           [
               'success' => $success,
               'message' => $message,
               'data'    => $data,
       ]);
    }


}
