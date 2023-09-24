<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BRJS Kesehatan</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="center-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('invalid'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('invalid') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form class="center-form" action="{{ route('login') }}" method="POST">
            @csrf
            <img src="{{ asset('image/logoBRJS.png') }}" alt="BRJS Kesehatan" width="80%">

            <h2>Login</h2>

            <div class="input-group">
                <input type="text" id="nomor_induk" name="nomor_induk" placeholder="NIK">
            </div>

            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Password">
            </div>

            <button type="submit">Login</button>

            <p>Masuk sebagai <a href="{{ route('home') }}">Tamu</a></p>
            <p>Registrasi <a href="{{ route('register_page') }}">di sini</a></p>
        </form>
    </div>
</body>
</html>
