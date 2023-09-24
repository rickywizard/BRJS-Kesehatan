<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Rumah Sakit</title>
    <link rel="stylesheet" href="{{ asset('css/add_hospital.css') }}">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form class="center-form" action="{{ route('edit_rumah_sakit', ['id_hospital' => $hospital->id_hospital]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <h1>Edit Rumah Sakit</h1>

            <div class="form-group">
                <label for="gambar">Gambar Rumah Sakit</label>
                <div class="image-preview">
                    <img
                        src="{{ Storage::url($hospital->gambar_hospital) }}"
                        alt="Preview Gambar"
                        style="
                            width: 300px;
                            height: 200px;
                            object-fit: cover;
                        "
                        id="foto-profil"
                    >
                </div>
                <input type="file" id="file-foto-profil" name="gambar">
            </div>

            <div class="form-group">
                <label for="nama">Nama Rumah Sakit</label>
                <input type="text" id="nama" name="nama" value="{{ $hospital->nama_hospital }}">
            </div>

            <div class="form-group">
                <label for="kota">Kota</label>
                <select id="kota" name="kota">
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bogor">Bogor</option>
                    <option value="Depok">Depok</option>
                    <option value="Tangerang">Tangerang</option>
                    <option value="Bekasi">Bekasi</option>
                    <option value="Bandung">Bandung</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Rumah Sakit</label>
                <textarea id="alamat" name="alamat" rows="4">{{ $hospital->alamat_hospital }}</textarea>
            </div>

            <div class="buttons">
                <button class="add-button" type="submit">Update</button>
                <a href="{{ route('rumah_sakit') }}" class="cancel-button">
                    Batal
                </a>
            </div>
        </form>
    </div>
</body>
</html>
