<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="center-container">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{$errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form class="center-form" action="{{ route('edit_user', ['id_user' => $user->id_user]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <h2>Edit Informasi Nasabah</h2>

            <div class="input-image">
                <img
                    src="{{ Storage::url($user->foto_profil) }}"
                    style="
                        width: 250px;
                        height: 250px;
                        object-fit: cover;
                    "
                    id="foto-profil"
                />
                <input type="file" id="file-foto-profil" name="image" />
            </div>

            <div class="input-group">
                <input type="text" id="nomor-induk" name="nomor_induk" placeholder="NIK" value="{{ $user->nomor_induk }}">
            </div>

            <div class="input-group">
                <input type="text" id="nama" name="nama" placeholder="Nama" value="{{ $user->nama }}">
            </div>

            <div class="input-group">
                <span>Kota</span>
                <select name="kota">
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bogor">Bogor</option>
                    <option value="Depok">Depok</option>
                    <option value="Tangerang">Tangerang</option>
                    <option value="Bekasi">Bekasi</option>
                    <option value="Bandung">Bandung</option>
                </select>
            </div>

            <div class="input-group">
                <input type="date" id="tanggal-lahir" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}">
            </div>

            <div class="input-group">
                <div class="radio-container">
                    <label><b>Gender</b></label>
                    <label>
                        Pria
                        <input type="radio" name="gender" value="male">
                    </label>
                    <label>
                        Wanita
                        <input type="radio" name="gender" value="female">
                    </label>
                </div>
            </div>

            <div class="input-group">
                <span>Golongan Darah</span>
                <select name="gol_darah">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>

            <div class="input-group">
                <span>Kelas</span>
                <select name="kelas">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div class="buttons">
                <button type="submit">Update</button>
                <a href="{{ route('administration') }}" class="cancel-button">
                    Batal
                </a>
            </div>
        </form>
    </div>
</body>
</html>
