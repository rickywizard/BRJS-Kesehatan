<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    @extends('navbar')

    @section('content')
        <div class="profile-container">
            <img src="{{ Storage::url($user->foto_profil) }}" alt="Profile Picture">
            <div class="profile-details">
                <h1>Profil</h1>
                <p><strong>Nama:</strong> {{ $user->nama }}</p>
                <p><strong>Nomor Induk:</strong> {{ $user->nomor_induk }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $user->tanggal_lahir }}</p>
                <p><strong>Kota:</strong> {{ $city->nama_kota }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $user->gender === 'male' ? 'Pria' : 'Wanita' }}</p>
                <p><strong>Golongan Darah:</strong> {{ $user->gol_darah }}</p>
                <p><strong>Kelas:</strong> {{ $user->kelas }}</p>
                <a href="{{ route('edit_profile_page', ['id_user' => $user->id_user]) }}">
                    <button>Update</button>
                </a>
            </div>
        </div>
    @endsection
</body>
</html>
