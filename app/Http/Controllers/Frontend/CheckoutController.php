<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;
use Http;
use App\Models\Alamat;
use App\Models\Cart;
use App\Models\CartInvoice;
use App\Models\Invoice;
use Auth;
use Session;
use DB;
use App\Services\CheckoutService;
use App\Repositories\Repository;


class CheckoutController extends Controller
{

    private $checkout;

    public function __construct(CheckoutService $checkout){
        $this->checkout = $checkout;
    }


    public function storeAlamat(Request $request)
    {
        $data = $this->checkout->storeAlamat($request);
        $success = true;
        $message = "Alamat Berhasil di Simpan";
        
        return Response::json(
            [
                'success' => $success,
                'message' => $message,
                'data'    => $data,
        ]);
    }

    public function storeCart(Request $request)
    {
        $cart = Cart::where('kode',$request->kode)
                      ->where('user_id',$request->user_id)
                      ->where('status',0)->count();

       
        if($cart == 0){
            $data = $this->checkout->storeCart($request);
            $success = true;
            $message = "Keranjang Berhasil di Simpan";
        }else{
            $data = null;
            $success = false;
            $message = "Domba Telah di Keranjang";  
           
        }             

        
        
        return Response::json(
            [
                'success' => $success,
                'message' => $message,
                'data'    => $data,
        ]);
    }

    public function checkout(Request $request)
    {

        $data = $this->checkout->checkout($request);
        
        return redirect()->route('checkout.form');

    }

    public function checkoutLive(Request $request)
    {
        $data = $this->checkout->checkoutLive($request);
        $success = true;
        $message = "Data Berhasil di Simpan, Silahkan Lanjutkan Transaksi";
              
        
        return Response::json(
            [
                'success' => $success,
                'message' => $message,
                'data'    => $data,
        ]);
    }

    public function submitpayment(Request $request)
    {
        return $this->checkout->submit($request);
    }

    public function notificationHandler(Request $request)
    {
        return $this->checkout->handler($request);
    }
    public function batal($id){
        $this->checkout->batal($id);
        return redirect()->back()->with('success','Transaksi Berhasil di Batalkan !');
    }



    
}