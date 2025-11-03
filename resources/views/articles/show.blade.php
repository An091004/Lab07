@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $article->title }}</h1>
        <p>{{ $article->content }}</p>
        <p><strong>ID:</strong> {{ $article->id }}</p>
        <p><strong>Tác giả (ID):</strong> {{ $article->user_id ?? 'N/A' }}</p>

        @php
            $routePrefix = Request::is('admin/*') ? 'admin.articles.' : 'articles.';
        @endphp
        @can('update', $article)
            <a href="{{ route($routePrefix . 'edit', $article) }}">Sửa</a>
        @endcan
        @can('delete', $article)
            <form action="{{ route($routePrefix . 'destroy', $article) }}" method="post" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Xóa bài viết này?')">Xóa</button>
            </form>
        @endcan
        @cannot('update', $article)
            <div class="mt-4 p-4 bg-blue-100 border border-blue-300 rounded">
                <p class="text-blue-700">Bạn không phải tác giả.</p>
            </div>
        @endcannot
    </div>
@endsection
