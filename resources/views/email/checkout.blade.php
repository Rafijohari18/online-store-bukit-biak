<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Domba {{ $invoice->no_invoice }} </title>
    <style type="text/css">
        *{
    margin:0;
    padding: 0;
}
body{
    margin: auto;
    background:#E6E6FA;
    font-family: Arial Narrow;
}
.page-wrap{
    width: 750px;
    height: 890px;
    margin: auto;
    margin-top: 10px;
    background: white;
    padding: 10px;
    margin-bottom: 10px;
}
.header img{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}
.header{
    text-align: center;
}
.header h2{
    position: relative; 
    display: inline-block;
}
.header h2:before{
    content: " ";
    position: absolute;
    border-bottom: 2px solid #1E90FF;
    width: 300px;
    left: -310px;
    top: 50%;
}
.header h2:after{
    content: " ";
    position: absolute;
    border-bottom: 2px solid #1E90FF;
    width: 300px;
    right: -310px;  
    top: 50%;
}
.identity{
    margin-top: 20px; 
    width:750px;
}
.identity p{
    padding: 3px;
}
.identity1{
    float: left;
    width: 360px;
    border: 0px solid red;
}
.identity2{
    float: right;
     width: 380px;
    border: 0px solid blue;
}
.table{
    float: left;
    margin-top: 30px;
}
.table td{
    padding-top: 30px;
    padding-bottom: 30px;
    padding-left: 7px;
}
.table p{
    float: right;
    margin-top: 15px;
}



    </style>
</head>
<body>
    <div class="page-wrap">
        <div class="header">
            <img src="{{ asset('assets/temp_frontend/images/logo.png')}}" alt="logo" >
            
        </div>
        <div class="identity">
            Hai {{ Auth::user()['name'] }} , <br>
            Pesananmu dari nomor order {{ $invoice->no_invoice }} satu langkah lagi akan selesai. Silahkan isi Data Alamat (Abaikan jika sudah mengisi)
            serta segera lakukan pembayarannya agar pesanan bisa di kirimkan.
        </div>
        <div class="table">
            <table style="width: 750px;border:1px solid black;;border-collapse: collapse;" border="1">
               <thead style="background-color: black;color:white;">
                    <th style="border:1px solid black;">No</th>
                    <th style="border:1px solid black;">Kode Kambing</th>
                    <th style="border:1px solid black;">Jenis Domba</th>
                    <th style="border:1px solid black;">Harga Domba</th>
                </thead>
                <tbody>
                        @php
                            $no     = 1;
                            $total = 0;
                        @endphp

                        @foreach($invoice->cart as $cart)
                        @php
                            $total += $cart->harga;
                        @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $cart->kode }}</td>
                            <td>{{ $cart->jenis }}</td>
                            <td>Rp. {{ number_format(($cart->harga), 0, ',', '.') }}</td>
                          
                        </tr>
                        @endforeach
                    
                      <tr>
                        <td colspan="3">Total Pembayaran </td>
                        <td >Rp. {{ number_format(($total), 0, ',', '.') }}</td>
                    </tr>
                  
                </tbody>
            </table>
          
        </div>  
       
      
    </div>
</body>
</html>