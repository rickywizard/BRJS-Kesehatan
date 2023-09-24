<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pertanyaan dan Aduan</title>
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">
</head>
<body>
    @extends('navbar')

    @section('content')
        <div class="container">
            <h1>Daftar Pertanyaan</h1>
            @foreach ($questions as $index => $question)
                <div class="question-card">
                    <h2>
                        @foreach ($users as $user)
                            @if ($user->id_user === $question->id_user)
                                {{ $user->nama }}
                            @endif
                        @endforeach
                    </h2>
                    <h3>{{ $question->email }}</h3>
                    <p>{{ $question->topik }}</p>
                    <p>{{ $question->deskripsi }}</p>
                </div>
            @endforeach
        </div>
    @endsection
</body>
</html>
