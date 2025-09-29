@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $article->title }}</h1>
        <p>{{ $article->content }}</p>
        <p><strong>ID:</strong> {{ $article->id }}</p>
    </div>
@endsection
