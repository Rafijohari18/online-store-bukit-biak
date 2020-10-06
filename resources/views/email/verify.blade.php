<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email </title>
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
    text-align: center;
}

.btn-aktivasi{
    color: #fff;
    width:140px;
    height:auto;
    background-color: #17a2b8;
    border-color: #007bff; 
    display: inline-block;
    font-weight: 300;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .350rem .50rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color 
    .15s ease-in-out,border-color .15s ease-in-out,box-shadow 
    .15s ease-in-out;
    
}
.regards{
    float: left;
    margin-top: 30px;
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
            Hai , <br>
            Terimakasih telah melakukan pendaftaran , silahkan tekan tombol di bawah ini agar akun anda bisa di gunakan !
        </div>

        <div class="alamat">
        <br>
            <a href="{{ $link }}">
                <button class="btn-aktivasi">Verifikasi Email</button>
            </a>    
          
        </div>  

        <div class="regards">
            Terimakasih, <br> <br>
            Hormat Kami <br><br><br><br>

            Admin Online Store Bukit Biak

        </div>  
       
      
    </div>
</body>
</html>