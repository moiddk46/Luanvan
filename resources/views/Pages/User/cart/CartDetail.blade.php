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
                            <div class="my-3 m-auto">
                                @if ($item->status_id == '1')
                                    <div id="bar-progress" class="mt-5 mt-lg-0">
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">1</span>
                                            </span>
                                            <h5 class="fw-bold">Đang xử lý</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step">
                                            <span class="number-container">
                                                <span class="number">2</span>
                                            </span>
                                            <h5 class="fw-bold">Đã xác nhận</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step">
                                            <span class="number-container">
                                                <span class="number">3</span>
                                            </span>
                                            <h5 class="fw-bold">Đang hoàn thành</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step">
                                            <span class="number-container">
                                                <span class="number">4</span>
                                            </span>
                                            <h5 class="fw-bold">Đã hoàn thành</h5>
                                        </div>
                                    </div>
                                @elseif($item->status_id == '2')
                                    <div id="bar-progress" class="mt-5 mt-lg-0">
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">1</span>
                                            </span>
                                            <h5 class="fw-bold">Đang xử lý</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">2</span>
                                            </span>
                                            <h5 class="fw-bold">Đã xác nhận</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step">
                                            <span class="number-container">
                                                <span class="number">3</span>
                                            </span>
                                            <h5 class="fw-bold">Đang hoàn thành</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step">
                                            <span class="number-container">
                                                <span class="number">4</span>
                                            </span>
                                            <h5 class="fw-bold">Đã hoàn thành</h5>
                                        </div>
                                    </div>
                                @elseif($item->status_id == '3')
                                    <div id="bar-progress" class="mt-5 mt-lg-0">
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">1</span>
                                            </span>
                                            <h5 class="fw-bold">Đang xử lý</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">2</span>
                                            </span>
                                            <h5 class="fw-bold">Đã xác nhận</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">3</span>
                                            </span>
                                            <h5 class="fw-bold">Đang hoàn thành</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step">
                                            <span class="number-container">
                                                <span class="number">4</span>
                                            </span>
                                            <h5 class="fw-bold">Đã hoàn thành</h5>
                                        </div>
                                    </div>
                                @else
                                    <div id="bar-progress" class="mt-5 mt-lg-0">
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">1</span>
                                            </span>
                                            <h5 class="fw-bold">Đang xử lý</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">2</span>
                                            </span>
                                            <h5 class="fw-bold">Đã xác nhận</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">3</span>
                                            </span>
                                            <h5 class="fw-bold">Đang hoàn thành</h5>
                                        </div>
                                        <div class="seperator"></div>
                                        <div class="step step-active">
                                            <span class="number-container">
                                                <span class="number">4</span>
                                            </span>
                                            <h5 class="fw-bold">Đã hoàn thành</h5>
                                        </div>
                                    </div>
                                @endif
                                <div class="row justify-content-center mt-3">
                                    <div class="col-3 align-content-center">
                                        <span>Ngày nhận hàng dự kiến: </span>
                                        <span id="date">{{ $item->complete_time }}</span>
                                    </div>
                                    @if ($item->status_id == '4')
                                        <div class="col-2">
                                            <a href="{{ route('giveOrder', ['data' => $item->order_id, 'serviceCode' => $item->service_type_code]) }}"
                                                class="btn btn-success  @if ($item->give_flag == 1) disabled @endif">Đã
                                                nhận được
                                                hàng</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($item->comfirm_user == '0')
                            <form action="{{ route('comfirmUser') }}" method="post" id="form_order1">
                                @csrf
                                <input type="hidden" name="orderId" value="{{ $item->order_id }}">
                                <input type="radio" id="delivery" name="deliveryOption" value={{ $item->delivery }}
                                    checked style="display: none;">
                                <input type="hidden" name="completeTime" value="2" id="completeTime">
                                @if ($item->delivery == '0')
                                    <div class="row mt-3 border-bottom">
                                        <div class="col-4 py-3">Tên</div>
                                        <div class="col-8 py-3">{{ $item->name }}</div>
                                        <input type="hidden" class="form-control" name="name" id="name"
                                            value="{{ $item->name }}">
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-4 py-3">Địa chỉ</div>
                                        <div class="col-8 py-3">{{ $item->address }}</div>
                                        <input type="hidden" class="form-control" name="address" id="address"
                                            value="{{ $item->address }}">
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-4 py-3">Số điện thoại</div>
                                        <div class="col-8 py-3">{{ $item->phone }}</div>
                                        <input type="hidden" class="form-control" name="sdt" id="sdt"
                                            value="{{ $item->phone }}">
                                    </div>
                                @else
                                    <div class="row mt-3 border-bottom">
                                        <div class="col-4 py-3">Nhận hàng tại</div>
                                        <div class="col-8 text-success p-3">
                                            <p class="fw-bold">VĂN PHÒNG GIAO DỊCH:</p>
                                            <p>125 Điện biên phủ, Phường 15, Quận Bình Thạnh, Thành phố Hồ Chí Minh</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="row border-bottom">
                                    <div class="col-4 py-3">Loại dịch vụ</div>
                                    <div class="col-8 py-3">{{ $item->service_type_name }}</div>
                                    <input type="hidden" name="serviceTypeName" value="{{ $item->service_type_name }}"
                                        id="serviceTypeName">
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-4 py-3">Ngày đặt hàng</div>
                                    <div class="col-8 py-3" id="date">{{ $item->order_date }}</div>
                                </div>
                                @if (!is_null($item->order_file_name))
                                    <div class="row border-bottom">
                                        <div class="col-4 py-3">Tệp đính kèm</div>
                                        <div class="col-8 py-3 row">
                                            <div class="col-6">{{ $item->order_file_name }}
                                            </div>
                                            <span class="col-4 align-content-center">
                                                <a href="{{ route('getDownloadOrder', ['data' => $item->order_id]) }}"
                                                    class="btn btn-success">
                                                    Tải xuống
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                <div class="row border-bottom">
                                    <div class="col-4 py-3">Số bản</div>
                                    <div class="col-8 py-3"> {{ $item->quantity }} Bản</div>
                                    <input type="hidden" name="quantity" value="{{ $item->quantity }}" id="quantity">
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-4 py-3">Số trang trong tài liệu</div>
                                    <div class="col-8 py-3"> {{ $item->page }} Trang @if ($item->check_page == '1')
                                            <div class="form-text text-danger fw-bold col-10">Số trang đã được đúng tôi
                                                kiểm
                                                tra,
                                                nếu không đúng vui lòng liên hệ lại với chúng tôi. </div>
                                        @endif
                                    </div>

                                    <input type="hidden" name="page" value="{{ $item->page }}" id="page">
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
                                    <div class="col-8 py-3">

                                        @if ($item->service_code == 'dichthuat')
                                            @if ($item->comfirm_user == '0')
                                                <select class="form-select form-select-md w-50"
                                                    aria-label="Small select example" name="statusReceipt"
                                                    id="statusReceipt">
                                                    @foreach ($statusReceipt as $row)
                                                        <option value="{{ $row->status_id }}">{{ $row->status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                {{ $item->sd_status }}
                                            @endif
                                        @else
                                            <select class="form-select form-select-md w-50"
                                                aria-label="Small select example" name="statusReceipt"
                                                id="statusReceipt">
                                                @foreach ($statusReceipt as $row)
                                                    <option value="{{ $row->status_id }}">{{ $row->status }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
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
                                    <div class="col-8 py-3">
                                        {{ is_null($item->nameStaff) ? 'Chưa phân công' : $item->nameStaff }}
                                    </div>
                                </div>
                                <div class="row fw-bold border-bottom">
                                    <div class="col-4 py-3">Tổng</div>
                                    <div class="col-8 py-3">
                                        <input type="hidden" id="currency1" name="sum"
                                            value="{{ $item->unit_price }}">
                                        <p id="currency">{{ $item->unit_price }}</p>
                                        @if ($item->unit_price < 10000)
                                            <div class="form-text text-danger fw-bold">Do tổng thanh toán nhỏ hơn 10.000 đ,
                                                quý
                                                khách
                                                vui lòng chọn thanh toán khi nhận hàng.</div>
                                        @endif
                                    </div>

                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <a href="{{ route('cart') }}" class="btn btn-secondary me-2">Quay
                                        lại</a>
                                    @if ($item->check_page != '0')
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" id="orderButton">Xác nhận</button>
                                    @endif

                                </div>

                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h5 class="text-center fw-bold">Thông tin đặt hàng</h5>
                                                @if ($item->delivery == '0')
                                                    <div class="row mt-3 ">
                                                        <div class="col-4 py-3 bg-body-secondary">Tên</div>
                                                        <div class="col-8 p-3">{{ $item->name }}</div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4 py-3 bg-body-secondary">Đia chỉ</div>
                                                        <div class="col-8 p-3">{{ $item->address }}</div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-4 py-3 bg-body-secondary">Số điện thoại</div>
                                                        <div class="col-8 p-3">{{ $item->phone }}</div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-4 py-3 bg-body-secondary">Nhận hàng tại</div>
                                                        <div class="col-8 text-success p-3">
                                                            <p class="fw-bold">VĂN PHÒNG GIAO DỊCH:</p>
                                                            <p>125 Điện biên phủ, Phường 15, Quận Bình Thạnh, Thành phố Hồ
                                                                Chí
                                                                Minh
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="row ">
                                                    <div class="col-4 py-3 bg-body-secondary">Loại dịch vụ</div>
                                                    <div class="col-8 p-3">{{ $item->service_type_name }}</div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-4 py-3 bg-body-secondary">Số bản</div>
                                                    <div class="col-8 p-3">{{ $item->quantity }} Bản</div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-4 py-3 bg-body-secondary">Số trang trong tài liệu</div>
                                                    <div class="col-8 p-3">{{ $item->page }} Trang</div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-4 py-3 bg-body-secondary">Thời gian hoàn thành</div>
                                                    <div class="col-8 p-3">{{ $item->order_date }} -
                                                        {{ $item->complete_time }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 py-3 bg-body-secondary">Hình thức thanh toán</div>
                                                    <div class="col-8 p-3" id="statusReceipt1"></div>
                                                </div>
                                                <div class="row fw-bold ">
                                                    <div class="col-4 py-3 bg-body-secondary">Tổng:</div>
                                                    <div class="col-8 p-3" id="currency">{{ $item->unit_price }}</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer m-auto">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-success" name="redirect"
                                                    id="button">Xác
                                                    nhận</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <input type="radio" id="delivery" name="deliveryOption" value={{ $item->delivery }}
                                checked style="display: none;">
                            <input type="hidden" name="completeTime" value="2" id="completeTime">
                            @if ($item->delivery == '0')
                                <div class="row mt-3 border-bottom">
                                    <div class="col-4 py-3">Tên</div>
                                    <div class="col-8 py-3">{{ $item->name }}</div>
                                    <input type="hidden" class="form-control" name="name" id="name"
                                        value="{{ $item->name }}">
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-4 py-3">Địa chỉ</div>
                                    <div class="col-8 py-3">{{ $item->address }}</div>
                                    <input type="hidden" class="form-control" name="address" id="address"
                                        value="{{ $item->address }}">
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-4 py-3">Số điện thoại</div>
                                    <div class="col-8 py-3">{{ $item->phone }}</div>
                                    <input type="hidden" class="form-control" name="sdt" id="sdt"
                                        value="{{ $item->phone }}">
                                </div>
                            @else
                                <div class="row mt-3 border-bottom">
                                    <div class="col-4 py-3">Nhận hàng tại</div>
                                    <div class="col-8 text-success p-3">
                                        <p class="fw-bold">VĂN PHÒNG GIAO DỊCH:</p>
                                        <p>125 Điện biên phủ, Phường 15, Quận Bình Thạnh, Thành phố Hồ Chí Minh</p>
                                    </div>
                                </div>
                            @endif
                            <div class="row border-bottom">
                                <div class="col-4 py-3">Loại dịch vụ</div>
                                <div class="col-8 py-3">{{ $item->service_type_name }}</div>
                                <input type="hidden" name="serviceTypeName" value="{{ $item->service_type_name }}"
                                    id="serviceTypeName">
                            </div>
                            <div class="row border-bottom">
                                <div class="col-4 py-3">Ngày đặt hàng</div>
                                <div class="col-8 py-3" id="date">{{ $item->order_date }}</div>
                            </div>
                            @if (!is_null($item->order_file_name))
                                <div class="row border-bottom">
                                    <div class="col-4 py-3">Tệp đính kèm</div>
                                    <div class="col-8 py-3 row">
                                        <div class="col-6">{{ $item->order_file_name }}
                                        </div>
                                        <span class="col-4 align-content-center">
                                            <a href="{{ route('getDownloadOrder', ['data' => $item->order_id]) }}"
                                                class="btn btn-success">
                                                Tải xuống
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            @endif
                            <div class="row border-bottom">
                                <div class="col-4 py-3">Số bản</div>
                                <div class="col-8 py-3"> {{ $item->quantity }} Bản</div>
                                <input type="hidden" name="quantity" value="{{ $item->quantity }}" id="quantity">
                            </div>
                            <div class="row border-bottom">
                                <div class="col-4 py-3">Số trang trong tài liệu</div>
                                <div class="col-8 py-3"> {{ $item->page }} Trang @if ($item->check_page == '1')
                                        <div class="form-text text-danger fw-bold col-10">Số trang đã được đúng tôi
                                            kiểm
                                            tra,
                                            nếu không đúng vui lòng liên hệ l   ại với chúng tôi. </div>
                                    @endif
                                </div>

                                <input type="hidden" name="page" value="{{ $item->page }}" id="page">
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
                                <div class="col-8 py-3">
                                    @if ($item->comfirm_user == '1')
                                        {{ $item->sd_status }}
                                    @else
                                        @if ($item->service_code == 'dichthuat')
                                            {{ $item->sd_status }}
                                        @else
                                            <select class="form-select form-select-md w-50"
                                                aria-label="Small select example" name="statusReceipt"
                                                id="statusReceipt">
                                                @foreach ($statusReceipt as $row)
                                                    <option value="{{ $row->status_id }}">{{ $row->status }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif
                                </div>
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
                                <div class="col-8 py-3">
                                    {{ is_null($item->nameStaff) ? 'Chưa phân công' : $item->nameStaff }}
                                </div>
                            </div>
                            <div class="row fw-bold border-bottom">
                                <div class="col-4 py-3">Tổng</div>
                                <div class="col-8 py-3">
                                    <input type="hidden" id="currency1" value="{{ $item->unit_price }}">
                                    <p id="currency">{{ $item->unit_price }}</p>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <a href="{{ route('cart') }}" class="btn btn-secondary me-2">Quay
                                    lại</a>
                            </div>
                        @endif
                    @endforeach
            @endif
        </div>
    @endsection
