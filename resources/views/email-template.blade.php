<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Welcome! {{$nama}}</h3></div>
                    @if($tipe == 'aktivasi')
                    <p> Silakan Klik Link Aktifasi akun anda <a href="http://127.0.0.1:8000/aktifasi/{{$email}}/{{$token}}">Aktivasi Akun</a></p>
                    @endif
                    @if($tipe == 'lupa_password')
                    <p>Password Anda : {{$token}}</p>
                    @endif
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh mail has been sent to your email address.') }}
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

