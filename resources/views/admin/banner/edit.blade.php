@extends('layouts.master_admin')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Chỉnh sửa banner</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Chỉnh sửa banner</li>
        </ol>
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name" style="font-weight: bold">Mã số</label>
                <input readonly type="text" name="id" class="form-control" value="{{ old('name', $banner->id) }}">
            </div>

            <div class="form-group">
                <img src="{{ $banner->getImage() }}" width="256px" class="img-preview">
                <label for="image" style="font-weight: bold">Hình ảnh</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-2">Lưu</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#image').change(function (event) {
                $(".img-preview").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
            });
        });
    </script>
@endsection

