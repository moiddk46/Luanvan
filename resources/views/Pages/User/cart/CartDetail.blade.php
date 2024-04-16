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
            <h3 class="text-center mt-5 mb-3 fw-bold">Chi tiết đơn hàng</h3>
            @if (isset($data) && !empty($data))
                <div class="mt-5 border border-danger">
                    @foreach ($data as $item)
                        <div class="border rounded bg-secondary-subtle p-3">
                            <h5 class="fw-bold mb-3">Tiến độ đơn hàng</h5>
                            <div class="my-3 w-50 m-auto">
                                <div class="progress-stacked">
                                    <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="15"
                                        aria-valuemin="0" aria-valuemax="100"
                                        style=" @if ($item->status_id == '1') width: 25%
                                    @elseif($item->status_id == '2')
                                        width: 50%
                                    @elseif($item->status_id == '3')
                                    width: 75%
                                    @else
                                    width: 100% @endif">
                                        <div class="progress-bar progress-bar bg-success"></div>
                                        <div class="bg-success">
                                            <i class="bi bi-truck progress-icon fs-5 text-light me-1 mb-2"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2 mx-2">
                                    @if ($item->status_id == '1')
                                        <span class="me-2 col-3 pt-2"> {{ $item->status }}</span>
                                    @elseif($item->status_id == '2')
                                        <span class="me-2 col-3 pt-2"> {{ $item->status }}</span>
                                    @elseif($item->status_id == '3')
                                        <span class="me-2 col-3 pt-2"> {{ $item->status }}</span>
                                    @else
                                        <a href="{{ route('giveOrder', ['data' => $item->order_id]) }}"
                                            class="btn  me-2 col-4 @if ($item->give_flag == 1) disabled @endif"
                                            style="background-color: rgb(247, 134, 14)">Đã nhận được
                                            hàng</a>
                                    @endif
                                    <div class="col pt-2">
                                        <span>Ngày nhận hàng dự kiến: </span>
                                        <span id="date">{{ $item->complete_time }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3 border-bottom">
                            <div class="col-4 py-3">Tên</div>
                            <div class="col-8 py-3">{{ $item->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-4 py-3">Địa chỉ</div>
                            <div class="col-8 py-3">{{ $item->address }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-4 py-3">Số điện thoại</div>
                            <div class="col-8 py-3">{{ $item->phone }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-4 py-3">Loại dịch vụ</div>
                            <div class="col-8 py-3">{{ $item->service_type_name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-4 py-3">Ngày đặt hàng</div>
                            <div class="col-8 py-3" id="date">{{ $item->order_date }}</div>
                        </div>
                        @if (!is_null($item->order_file_name))
                            <div class="row border-bottom">
                                <div class="col-4 py-3">Tệp đính kèm</div>
                                <div class="col-8 py-3">{{ $item->order_file_name }}</div>
                            </div>
                        @endif
                        <div class="row border-bottom">
                            <div class="col-4 py-3">Số bản</div>
                            <div class="col-8 py-3"> {{ $item->quantity }} Bản</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-4 py-3">Trạng thái đơn hàng</div>
                            <div class="col-8 py-3"><span
                                    class="badge  
                                    @if ($item->status_id == '1') text-bg-warning
                                    @elseif($item->status_id == '2')
                                        text-bg-primary
                                    @elseif($item->status_id == '3')
                                        text-bg-secondary
                                    @else
                                        text-bg-success @endif
                                        rounded-pill d-inline">{{ $item->status }}</span>
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-4 py-3">Hình thức thanh toán</div>
                            <div class="col-8 py-3">{{ $item->sd_status }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-4 py-3">Trạng thái thanh toán</div>
                            <div class="col-8 py-3"><span
                                    class="badge  
                                    @if ($item->sr_status_id == '1') text-bg-warning
                                    @else
                                    text-bg-success @endif
                                rounded-pill d-inline">{{ $item->sr_status }}</span>
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-4 py-3">Nhân viên phụ trách</div>
                            <div class="col-8 py-3">{{ is_null($item->nameStaff) ? 'Chưa phân công' : $item->nameStaff }}
                            </div>
                        </div>
                        <div class="row fw-bold border-bottom">
                            <div class="col-4 py-3">Tổng</div>
                            <div class="col-8 py-3" id="currency">{{ $item->unit_price }} </div>
                        </div>
                </div>
            @endforeach
        @else
            <p class="mt-5 text-center">Chưa có đơn hàng nào.</p>
            @endif
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ route('cart') }}" class="btn btn-secondary">Quay
                    lại</a>
            </div>

        </div>
    @endsection
