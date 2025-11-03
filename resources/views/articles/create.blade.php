@extends('layouts.app')
@section('title','Tạo bài viết')
@section('content')
<h2>Tạo bài viết</h2>
<x-alert type="warning" title="Lưu ý">Dữ liệu hiện chỉ mô phỏng (chưa lưu DB).</x-alert>
<form action="{{ route('articles.store') }}" method="post"
    enctype="multipart/form-data">
    @csrf
    <label>Tiêu đề</label>
    <input type="text" name="title" value="{{ old('title') }}">
    @error('title') <div style="color:#b91c1c">{{ $message }}</div> @enderror
    <label>Nội dung</label>
    <textarea name="body" rows="6">{{ old('body') }}</textarea>
    @error('body') <div style="color:#b91c1c">{{ $message }}</div> @enderror
    <label>Ảnh minh hoạ (tuỳ chọn)</label>
    <input type="file" name="image" accept=".jpg,.jpeg,.png">
    @error('image') <div style="color:#b91c1c">{{ $message }}</div> @enderror
    <button type="submit">Lưu</button>

</form>
@push('styles')
<style>
    .btn {
        padding: 8px 18px;
        border-radius: 6px;
        border: none;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-primary {
        background: #2563eb;
        color: #fff;
    }

    .btn-danger {
        background: #dc2626;
        color: #fff;
    }
</style>
@endpush
@endsection