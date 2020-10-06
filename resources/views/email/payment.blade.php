<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Domba {{ $invoice->no_invoice }} Sedang Kami Siapkan </title>
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
    padding: 5px;
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
    padding: 5px;
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

.alamat{
    float: left;
    margin-top: 30px;
    padding: 5px;
}
.alamat td{
    padding-top: 5px;
    padding-bottom: 5px;
    padding: 5px;
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
            Terimakasih telah melakukan pembayaran , Pesananmu dari nomor order {{ $invoice->no_invoice }} sedang kami siapkan .
            Semoga pengalaman berbelanjamu di sini semakin menyenangkan!
        </div>

        <div class="alamat">
        <h2>Alamat Pengiriman Pesanan</h2>
            <table >
                <tr>
                    <td>Nama Penerima</td>
                    <td>{{ $invoice->User->Alamat->nama }}</td>
                </tr>
                <tr>
                    <td>Alamat Penerima</td>
                    <td>
                            <?php echo ucwords(strtolower($invoice->User->Alamat->Provinsi->name)) ?> ,
                            <?php echo ucwords(strtolower($invoice->User->Alamat->Kota->kota)) ?> ,
                            <?php echo ucwords(strtolower($invoice->User->Alamat->Kecamatan->kecamatan)) ?> ,
                            <?php echo ucwords(strtolower($invoice->User->Alamat->Desa->desa)) ?>                </tr>
                <tr>
                    <td>Telepon</td>
                    <td>{{ $invoice->User->Alamat->no_telp }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ Auth::user()['email'] }}</td>
                </tr>
            </table>
          
        </div>  

        <div class="table">
            <table border="0" style="width: 750px; border-collapse: collapse;">
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
                        <td></td>
                        <td>Total Pembayaran </td>
                        <td></td>
                        <td >Rp. {{ number_format(($total), 0, ',', '.') }}</td>
                    </tr>
                  
                </tbody>
            </table>
          
        </div>  
       
      
    </div>
</body>
</html>