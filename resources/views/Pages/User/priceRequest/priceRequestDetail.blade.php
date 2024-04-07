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
                                    <td>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="name" id="name"
                                                value="{{ $item->name }}">
                                        </div>
                                    </td>
                                    <input type="hidden" name="idUser" value="{{ $item->id_user }}">
                                    <input type="hidden" name="price"
                                        value="{{ !empty($item->price) ? $item->price : '0' }}">
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>
                                        <div class="col-8">
                                            <input class="form-control" type="text" name="address" id="address"
                                                value="{{ $item->address }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td>
                                        <div class="col-8">
                                            <input class="form-control" type="tel" name="sdt" id="sdt"
                                                value="{{ $item->phone }}" pattern="[0-9]{10,11}"
                                                title="Số điện thoại phải có từ 10 đến 11 chữ số">
                                        </div>
                                    </td>
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
                                        <div class="col-2">
                                            <input type="number" id="quantity" name="quantity" class="form-control"
                                                value="1">
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
                                            @if ($item->status_id == '2') text-bg-warning
@else
text-bg-success @endif
                                                rounded-pill d-inline">{{ $item->status }}</span>
                                        <input type="hidden" name="status" value="{{ $item->status_id }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Báo giá</th>
                                    <td>
                                        <div class="col-8" id="currency">
                                            {{ !empty($item->price) ? $item->price : '0' }}

                                        </div>
                                        <input type="hidden" id="currency1"
                                            value="{{ !empty($item->price) ? $item->price : '0' }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Báo giá</th>
                                    <td>
                                        <select class="form-select form-select-md w-50" aria-label="Small select example"
                                            name="statusReceipt" id="statusReceipt">
                                            @foreach ($statusReceipt as $row)
                                                <option value="{{ $row->status_id }}">{{ $row->status }}</option>
                                            @endforeach
                                        </select>
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
                        <a href="{{ route('priceRequestUser') }}" class="btn btn-secondary me-2">Quay
                            lại</a>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Đặt hàng
                        </button>
                    </div>



                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h5 class="text-center fw-bold">Thông tin đặt hàng</h5>
                                    <div class="row mt-3 ">
                                        <div class="col-4 py-3 bg-body-secondary">Tên</div>
                                        <div class="col-8 p-3" id="name1"></div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4 py-3 bg-body-secondary">Đia chỉ</div>
                                        <div class="col-8 p-3" id="address1"></div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4 py-3 bg-body-secondary">Số điện thoại</div>
                                        <div class="col-8 p-3" id="sdt1"></div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4 py-3 bg-body-secondary">Loại dịch vụ</div>
                                        <div class="col-8 p-3" id="service1"></div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4 py-3 bg-body-secondary">Số bản</div>
                                        <div class="col-8 p-3" id="quantity1"></div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4 py-3 bg-body-secondary">Hình thức thanh toán</div>
                                        <div class="col-8 p-3" id="statusReceipt1"></div>
                                    </div>
                                    <div class="row fw-bold ">
                                        <div class="col-4 py-3 bg-body-secondary">Tổng</div>
                                        <div class="col-8 p-3" id="sum"> </div>
                                        <input type="hidden" name="sum" id="sum1" value="">
                                    </div>
                                </div>
                                <div class="modal-footer m-auto">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-success">Xác nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>

    </div>
@endsection
