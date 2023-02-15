@extends('layouts.master_admin')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sửa sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Sửa sản phẩm</li>
        </ol>
        <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="id" style="font-weight: bold">Mã số</label>
                <input readonly type="text" name="id" class="form-control" value="{{ old('name', $product->id) }}">
                @error('id')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" style="font-weight: bold">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
                @error('name')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" style="font-weight: bold">Mô tả</label>
                <textarea name="description" cols="30" rows="10" class="form-control">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" style="font-weight: bold">Đơn giá</label>
                <input type="text" name="price" class="form-control" value="{{ old('name', $product->price) }}">
                @error('price')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <img src="{{ $product->getImage() }}" width="256px" class="img-preview">
                <label for="image" style="font-weight: bold">Hình ảnh</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id" style="font-weight: bold">Loại sản phẩm</label>
                <select name="category_id" class="form-control">
                    <option value="">--Chọn--</option>
                    @foreach($listCategory as $category)
                        @if($product->category_id == $category->id)
                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('category_id')
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

