<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rumah Sakit</title>
    <link rel="stylesheet" href="{{ asset('css/hospital.css') }}">
</head>
<body>
    @extends('navbar')

    @section('content')
        <div class="base-container">
            <h1>Daftar Rumah Sakit</h1>
            <div class="searching-bar">
                <form action="{{ route('search') }}" method="GET">
                    @csrf
                    <input type="text" name="search" placeholder="Cari rumah sakit...">
                </form>
                @if (auth()->check())
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('add_rumah_sakit_page') }}">
                            <button class="add-button">Tambah Rumah Sakit</button>
                        </a>
                    @endif
                @endif
            </div>
            <div class="hospital-cards">
                @foreach ($hospitals as $hospital)
                    <div class="hospital-card">
                        <div class="hospital-information">
                            <div class="hospital-name">{{ $hospital->nama_hospital }}</div>
                            <div class="hospital-address">{{ $hospital->alamat_hospital }}</div>
                            <div class="buttons">
                                <a href="{{ route('edit_rumah_sakit_page', ['id_hospital' => $hospital->id_hospital]) }}">
                                    <button class="update-button">Update</button>
                                </a>
                                <form action="{{ route('delete_rumah_sakit') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id_hospital" value="{{ $hospital->id_hospital }}">
                                    <button class="delete-button">Delete</button>
                                </form>
                            </div>
                        </div>
                        <img
                            src="{{ Storage::url($hospital->gambar_hospital) }}"
                            alt="{{ $hospital->nama_hospital }}"
                            style="
                                width: 300px;
                                height: 200px;
                                object-fit: cover;
                            "
                        >
                    </div>
                @endforeach
            </div>
        </div>
        <div class="custom-pagination">
            {{ $hospitals->appends(['search' => request()->input('search')])->links('pagination::bootstrap-4') }}
        </div>
    @endsection
</body>
</html>
