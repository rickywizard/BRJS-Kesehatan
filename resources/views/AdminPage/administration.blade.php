<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrasi</title>
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    @extends('navbar')

    @section('content')
    <div class="base-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h1>Informasi Nasabah</h1>
        <table>
            <thead>
                <tr>
                    <th>Nomor Induk</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Kota</th>
                    <th>Jenis Kelamin</th>
                    <th>Golongan Darah</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nasabahs as $index => $nasabah)
                    <tr>
                        <td>{{ $nasabah->nomor_induk }}</td>
                        <td>{{ $nasabah->nama }}</td>
                        <td>{{ $nasabah->tanggal_lahir }}</td>
                        <td>
                            @foreach ($cities as $city)
                                @if ($city->id_kota == $nasabah->id_kota)
                                    {{ $city->nama_kota }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $nasabah->gender === 'male' ? 'Pria' : 'Wanita' }}</td>
                        <td>{{ $nasabah->gol_darah }}</td>
                        <td>{{ $nasabah->kelas }}</td>

                        <td class="buttons">
                            <a href="{{ route('edit_user_page', ['id_user' => $nasabah->id_user]) }}">
                                <button class="edit-button">Update</button>
                            </a>
                            <form action="{{ route('delete_user') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id_user" value="{{ $nasabah->id_user }}">
                                <button class="delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</body>
</html>
