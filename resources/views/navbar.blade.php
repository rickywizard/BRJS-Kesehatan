<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<div class="top-bar">
    <img
        src="{{ asset('image/logoBRJS.png') }}"
        alt="BRJS Kesehatan"
        width="25%"
    >
    <a href="{{ route('logout') }}">
        <div class="icon-container">
            <img src="{{ asset('image/logout.svg') }}" alt="" class="icon">
            <p>Logout</p>
        </div>
    </a>
</div>
<nav class="nav-bar">
    <ul class="nav-list">
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('rumah_sakit') }}">Rumah Sakit</a></li>

        @if (auth()->check())
            <li><a href="{{ route('profile', ['id_user' => Auth::user()->id_user]) }}">Profil</a></li>
            @if (auth()->user()->role === 'admin')
                <li><a href="{{ route('pertanyaan_aduan') }}">Pertanyaan Masuk</a></li>
                <li><a href="{{ route('administration') }}">Administrasi</a></li>
            @endif
        @endif
    </ul>
</nav>
{{-- button add pesan aduan --}}
@if (auth()->check())
    <a href="{{ route('add_aduan_page') }}">
        <button class="floating-button">Kirim Pertanyaan</button>
    </a>
@endif

@yield('content')
