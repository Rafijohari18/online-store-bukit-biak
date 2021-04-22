<?php

namespace App\Services;

use App\Models\Alamat;
use App\Models\Cart;
use App\Models\Transaksi;
use App\Models\CartInvoice;
use App\Models\Invoice;
use App\Models\TarifBiaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Auth;
use Carbon\Carbon;
use App\Notifications\CheckoutLiveNotification;
use Notification;
use App\Mail\CheckoutLiveEmail;
use App\Mail\CheckoutEmail;
use App\Mail\PaymentEmail;
use Illuminate\Support\Facades\Mail;
use RafiJohari\RajaOngkir\Cost;


class CheckoutService
{
    private $alamat,$cart,$transaksi,$invoice,$cart_invoice,$tarifbiaya;

    public function __construct(
        Alamat $alamat,
        Cart $cart,
        Transaksi $transaksi,
        CartInvoice $cart_invoice,
        Invoice $invoice,
        TarifBiaya $tarifbiaya
        )
    {
        $this->alamat = $alamat;
        $this->cart = $cart;
        $this->transaksi = $transaksi;
        $this->cart_invoice = $cart_invoice;
        $this->invoice = $invoice;
        $this->tarifbiaya = $tarifbiaya;
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function storeAlamat($request){

        $this->alamat::updateOrCreate(['user_id' => $request->user_id],
        [
            'nama'          => $request->nama,
            'no_telp'       => $request->no_telp,
            'provinsi_id'   => $request->provinsi_id,
            'kota_id'       => $request->kota_id,
            'alamat'         => $request->alamat,
            // 'kecamatan_id'  => $request->kecamatan_id,
            // 'desa_id'       => $request->desa_id,
        ]);

        // $kota_asal_id = 430;
        // $kota_tujuan_id =  $request->provinsi_id;
        // $berat = 1700; // dalam gram
        // $kurir = "jne";
        // $biaya_jne = Cost::getcost($kota_asal_id, $kota_tujuan_id, $berat, $kurir);

        // $kota_asal_id = 430;
        // $kota_tujuan_id =  $request->provinsi_id;
        // $berat = 1700; // dalam gram
        // $kurir = "tiki";
        // $biaya_tiki = Cost::getcost($kota_asal_id, $kota_tujuan_id, $berat, $kurir);

        // $kota_asal_id = 430;
        // $kota_tujuan_id =  $request->provinsi_id;
        // $berat = 1700; // dalam gram
        // $kurir = "pos";
        // $biaya_pos = Cost::getcost($kota_asal_id, $kota_tujuan_id, $berat, $kurir);
        
        // $merge = array_merge($biaya_jne,$biaya_tiki,$biaya_pos);
        
        // $cek_tarif =  $this->tarifbiaya::where('user_id', $request->user_id)->count();

        // if($cek_tarif > 0){
        //   $this->tarifbiaya::where('user_id', $request->user_id)->delete();
        // }

        // foreach($merge as $val){
          
        //   $this->tarifbiaya::create([
        //       'user_id' => $request->user_id,
        //       'code' => $val['code'],
        //       'costs' => $val['costs'],
              
        //     ]);
        // }
        


    }

    public function storeCart($request){
        $harga =  ($request->quantity * $request->harga);

        $cart = $this->cart::create([
            'kode'       => $request->kode,
            'jenis'      => $request->jenis,
            'harga'      => $harga,
            'user_id'    => $request->user_id,
            'berat'      => $request->berat,
            'qty'        => $request->quantity,
        ]);

      

    }

    public function checkoutLive($request)
    {
        $harga =  ($request->quantity * $request->harga);
        $cart = $this->cart::create([
            'kode'       => $request->kode,
            'jenis'      => $request->jenis,
            'harga'      => $request->harga,
            'user_id'    => $request->user_id,
            'status'     => 1,
            'berat'      => $request->berat,
            'qty'        => $request->quantity,
        ]);
        

        $query      = $this->invoice->orderBy('id','DESC')->first();
        $carbonNow  = Carbon::now();
        $user       =  Auth::user()['name'] ;

        if ($query != null) {
            $kd = ((int)$query->id) + 1;
        }else {
            $kd = "1";
        }

            if($this->invoice->count() == 0)
            {
            $no_invoice = "1/INV-STORE-TERNAK/$user/$carbonNow->month/$carbonNow->year";
            } else {
            $no_invoice = "$kd/INV-STORE-TERNAK/$user/$carbonNow->month/$carbonNow->year";
            }


        $invoice  = $this->invoice::create([
            'no_invoice'     => $no_invoice,
            'user_id'        => Auth::user()['id'],
        ]);



        $cart_invoice  = $this->cart_invoice::create([
                'cart_id'     => $cart->id,
                'invoice_id'  => $invoice->id,
        ]);

        $list_invoice =  $this->invoice::with('cart')
        ->where('no_invoice',$invoice->no_invoice)->first();

        // Mail::to(Auth::user()->email)->send(new CheckoutLiveEmail($list_invoice));


    }

    public function checkout($request)
    {
        $id_cart    = $request->id;

        $this->cart::whereIn('id',$id_cart)->update([
            'status'        => 1,
         ]);


        $query      = $this->invoice->orderBy('id','DESC')->first();
        $carbonNow  = Carbon::now();
        $user       =  Auth::user()['name'] ;

        if ($query != null) {
            $kd = ((int)$query->id) + 1;
        }else {
            $kd = "1";
        }

            if($this->invoice->count() == 0)
            {
            $no_invoice = "1/INV-STORE-TERNAK/$user/$carbonNow->month/$carbonNow->year";
            } else {
            $no_invoice = "$kd/INV-STORE-TERNAK/$user/$carbonNow->month/$carbonNow->year";
            }


        $invoice  = $this->invoice::create([
            'no_invoice'     => $no_invoice,
            'user_id'        => Auth::user()['id'],
        ]);

        foreach($id_cart as $cart){

            $cart_invoice  = $this->cart_invoice::create([
                'cart_id'     => $cart,
                'invoice_id'  => $invoice->id,
            ]);
        }

        $list_invoice =  $this->invoice::with('cart')
        ->where('no_invoice',$invoice->no_invoice)->first();

        Mail::to(Auth::user()->email)->send(new  CheckoutEmail($list_invoice));



        }

    public function submit($request){

        \DB::transaction(function() use($request){

            $payload = [
                'transaction_details' => [
                    'order_id'      => $request->kodeinvoice,
                    'gross_amount'  => 1000,
                ],
                'customer_details' => [
                    'first_name'    => Auth::user()['name'],
                    'email'         => Auth::user()['email'],
                    // 'phone'         => '08888888888',
                ],
                'item_details' => [
                    [
                        'id'       => 5,
                        'price'    => $request->jumlah,
                        'quantity' => 1,
                        'name'     => 'Order Domba',

                    ]
                ]
            ];
            $snapToken = Veritrans_Snap::getSnapToken($payload);
            $invoice = $this->invoice::where('id',$request->idinvoice)
                    ->update([
                        'snap_token'        =>  $snapToken,
                        'status_transaksi'  => 'pending',
                    ]);

            $this->response['snap_token'] = $snapToken;
        });

        $list_invoice =  $this->invoice::with('cart','User')
        ->where('id',$request->idinvoice)->first();

  
      

      
        return response()->json($this->response);
    }


    public function handler($request){
        $notif = new Veritrans_Notification();
        \DB::transaction(function() use($notif) {
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;
        $invoice = Invoice::where('no_invoice',$orderId)->first();

        $id_invoice = $invoice->id; 
        $cart_invoice =  CartInvoice::where('invoice_id',$id_invoice)->get();

        $invoice->update([
        'api_midtrans' => [
          "transaction_time"   => $notif->transaction_time,
          "transaction_status" => $notif->transaction_status,
          "transaction_id"     => $notif->transaction_id,
          "status_message"     => $notif->status_message,
          "status_code"        => $notif->status_code,
          "signature_key"      => $notif->signature_key,
          "settlement_time"    => $notif->settlement_time,
          "payment_type"       => $notif->payment_type,
          "order_id"           => $notif->order_id,
          "merchant_id"        => $notif->merchant_id,
          "gross_amount"       => $notif->gross_amount,
          "fraud_status"       => $notif->fraud_status,
          "currency"           => $notif->currency,
          "approval_code"      => $notif->approval_code
        ]
      ]);



      if ($transaction == 'capture') {
        if ($type == 'credit_card') {

          if($fraud == 'challenge') {
            $invoice->update([
              'status_transaksi'  => 'pending'
            ]);
          } else {

            $invoice->update([
              'status_transaksi'  => 'sukses',
            ]);

            foreach($cart_invoice as $cart){
                Cart::whereIn('id', [$cart->cart_id])->update(['status' => 2]);
            }

          }
        }
      } elseif ($transaction == 'settlement') {
            $invoice->update([
              'status_transaksi'  => 'sukses'
            ]);

            foreach($cart_invoice as $cart){
              Cart::whereIn('id', [$cart->cart_id])->update(['status' => 2]);
            }

      } elseif($transaction == 'pending'){
        $invoice->update([

          'status_transaksi'  => 'pending'
        ]);
      } elseif ($transaction == 'deny') {
        $invoice->update([

          'status_transaksi'  => 'ditolak'
        ]);
      } elseif ($transaction == 'expire') {
        $invoice->update([

          'status_transaksi'  => 'kadaluarsa'
        ]);
      } elseif ($transaction == 'cancel') {
        $invoice->update([
          'status_transaksi'  => 'gagal'
        ]);
      }

      });

      return 'Sukses !';
      }



}

