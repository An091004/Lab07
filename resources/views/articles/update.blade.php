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