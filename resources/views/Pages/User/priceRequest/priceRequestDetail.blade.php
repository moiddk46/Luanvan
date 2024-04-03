@extends('Layouts.User.MasterLayout');

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 1050;">
                <div id="myToast"
                    class="toast align-items-center {{ session('status') == true ? 'text-bg-success' : 'text-bg-danger' }}"
                    role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <h5>Danh sách giỏ hàng</h5>
            @if (isset($data) && !empty($data))
                <form action="{{ route('order') }}" method="post">
                    @csrf
                    <table class="table align-middle mb-0 bg-white mt-5 table-striped">
                        <thead>
                            <tr>
                                <th class="w-25">Tiêu đề</th>
                                <th>Nội dung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <th>Mã báo giá</th>
                                    <td>{{ $item->request_id }}</td>
                                    <input type="hidden" name="requestId" value="{{ $item->request_id }}">
                                </tr>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <td id="name">{{ $item->name }}</td>
                                    <input type="hidden" name="idUser" value="{{ $item->id_user }}">
                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                    <input type="hidden" name="address" value="{{ $item->address }}">
                                    <input type="hidden" name="sdt" value="{{ $item->phone }}">
                                    <input type="hidden" name="price"
                                        value="{{ !empty($item->price) ? $item->price : '0' }}">
                                </tr>
                                <tr>
                                    <th>Loại dịch vụ</th>
                                    <td id="service">{{ $item->service_type_name }}</td>
                                    <input type="hidden" name="serviceTypeCode" value="{{ $item->service_type_code }}">
                                </tr>
                                <tr>
                                    <th>Ngày yêu cầu</th>
                                    <td id="date">{{ $item->request_date }}</td>
                                </tr>
                                <tr>
                                    <th>Số bản</th>
                                    <td>
                                        <div class="col-6">
                                            <input type="number" id="quantity" name="quantity" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tài liệu</th>
                                    <td class="row">
                                        <span class="col-8">
                                            {{ $item->request_file }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <span
                                            class="badge  
                                            @if ($item->status_id == '5') text-bg-warning
@else
text-bg-success @endif
                                                rounded-pill d-inline">{{ $item->status }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Báo giá</th>
                                    <td>
                                        <div class="col-8" id="currency">
                                            {{ !empty($item->price) ? $item->price : '0' }}

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Thư báo giá</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-8">
                                                @if (!empty($item->price_letter))
                                                    {{ $item->price_letter }}
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('cart') }}" class="btn btn-secondary me-2">Quay
                            lại</a>
                        <button type="submit" class="btn btn-success">Đặt hàng</button>
                    </div>
                </form>
            @endif
        </div>

    </div>
@endsection
