@extends('layout')
@section('title','Trang chủ')

@section('content')
    <h1 class="text-center">Thông tin khách hàng</h1>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateCustomer">Thêm mới</button>
    
    <table class="table-responsive table table-bordered mt-3">
        <thead>
        <tr class="text-center table-active">
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @forelse($customers as $customer)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td class="text-center">
                    <p>{{$customer->full_name}}</p>
                    <img class="img-fluid rounded-circle" width="200px" src="{{$customer->avatar_url}}"/>
                </td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->phone}}</td>
                <td>
                    <form
                        onsubmit="return confirm('Bạn có muốn xoá?')"
                        method="POST" action="{{route('delete-customer')}}">
                        @csrf
                        @method('DELETE')
                        <input hidden name="customer_id" value="{{$customer->id}}">
                        <button type="submit" class="btn btn-danger">Xoá</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Không có dữ liệu</td>
            </tr>
        @endforelse
        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="modalCreateCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{route('create-customer')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tạo khách hàng mới</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control" placeholder="Họ tên" name="full_name" required>
                        <input class="form-control mt-2" type="date" placeholder="Ngày sinh" name="dob" required>
                        <input class="form-control mt-2" type="text" placeholder="SDT" name="phone" required>
                        <input class="form-control mt-2" type="email" placeholder="Email" name="email" required>
                        <input class="form-control mt-2" type="file" name="avatar_file" required accept="image/*">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
