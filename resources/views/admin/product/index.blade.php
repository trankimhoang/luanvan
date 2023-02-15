@extends('layouts.master_admin')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Danh sách sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-2">Thêm</a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Danh sách
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Mã số</th>
                        <th>Tên sản phẩm</th>
                        <th>Tên loại</th>
                        <th>Mô tả</th>
                        <th>Hình ảnh</th>
                        <th>Đơn giá</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Mã số</th>
                        <th>Tên sản phẩm</th>
                        <th>Tên loại</th>
                        <th>Mô tả</th>
                        <th>Hình ảnh</th>
                        <th>Đơn giá</th>
                        <th>Thao tác</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($listProduct as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '' }}</td>
                            <td>{{ $product->description }}</td>
                            <td>
                                <img src="{{ $product->getImage() }}" alt="" width="128px">
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <ul class="list-inline m-0">
                                    <li class="list-inline-item">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success btn-sm rounded-0"><i class="fa fa-edit"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-0"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
