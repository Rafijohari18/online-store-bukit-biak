<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Validator;

class TransaksiController extends Controller
{
    public $successStatus = 200;

    public function getData(Request $request)
    {
        $success = Invoice::with('cart','User')->whereIn('status_transaksi',['sukses','pending'])->get();
    
        return response()->json(['success'=> $success], $this->successStatus); 
    }
}
