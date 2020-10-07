<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Jsonable;
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
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexController extends Controller
{

    public function index(Request $request)
    {
        // via http
        $api = Http::get('https://apps.bukitbiak.com/api/client?secret_key=1hEISuIYPDHAkOoq4XQr0Z37xC6FBZWdxbrSkWghSqlEV2X7iX4hepbArzzgzGxVJg8GTYLcf7P0aMGCsWS7IpqCAnRcvnSPFKPT');
        $data['api'] = $api->json();
    
        $kambing = $data['api']['data_kambing'];

        $data['kambing'] = $this->paginate($kambing);

        return view('frontend.index',compact('data'));
    }

    public function paginate($items, $perPage = 9, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function filterJk(Request $request)

    {    
        $api = Http::get('https://apps.bukitbiak.com/api/client?secret_key=1hEISuIYPDHAkOoq4XQr0Z37xC6FBZWdxbrSkWghSqlEV2X7iX4hepbArzzgzGxVJg8GTYLcf7P0aMGCsWS7IpqCAnRcvnSPFKPT');
        $data['api'] = $api->json();
    
        $kambing = collect($data['api']['data_kambing']);

        if($request->search == "laki"){
            $data['kambing']      =  $this->paginate($kambing->where('kelamin',1)); 
                
        }elseif($request->search == "perempuan"){
            $data['kambing']  =  $this->paginate($kambing->where('kelamin',0)); 
        }elseif($request->search == "reset"){
            $data['kambing']  =  $this->paginate($kambing);
        }
        return view('frontend.filter-jk',compact('data'));

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
       

        $api = Http::get('https://apps.bukitbiak.com/api/client?secret_key=1hEISuIYPDHAkOoq4XQr0Z37xC6FBZWdxbrSkWghSqlEV2X7iX4hepbArzzgzGxVJg8GTYLcf7P0aMGCsWS7IpqCAnRcvnSPFKPT');
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

    public function countCart(Request $request)
    {
        $data['cart'] = Cart::where('user_id',Auth::user()['id'])
                        ->where('status',0)->count();

       return view('frontend.count-cart',compact('data'));
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
