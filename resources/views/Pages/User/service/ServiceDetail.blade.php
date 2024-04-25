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
            <h3 class="text-center mt-5 mb-3 fw-bold">Báo giá</h3>
            @if (isset($detailService))
                <div>
                    {!! $detailService->detail_price !!}
                </div>
            @endif
            @if ($detailService->service_code == 'dichthuat')
                <div class="w-50 form-order rounded bg-light p-3 m-auto">
                    <h5 class="text-center">Yêu cầu báo giá</h5>
                    <form method="post" action="{{ route('priceRequest') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="serviceTypeCode" value="{{ $detailService->service_type_code }}">
                        <div class="mb-3">
                            <label for="" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        @error('address')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="sdt" class="form-label">Số điện thoại</label>
                            <input type="phone" class="form-control" name="sdt" id="sdt">
                        </div>
                        @error('sdt')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="content" style="height: 100px" name="content" id="content"></textarea>
                        </div>
                        @error('content')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3 row">
                            <div class="col-8">
                                <label for="formFile" class="form-label">Gửi tài liệu</label>
                                <input class="form-control" type="file" id="formFile" name="files">
                                @error('files')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="quanlity" class="form-label">Số bản</label>
                                <input class="form-control" type="number" id="quantity" min="1" value="1"
                                    name="quantity">
                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <button class="btn btn-success">Yêu cầu báo giá</button>
                        </div>

                    </form>
                </div>
            @else
                <div class="w-50 form-order rounded bg-light p-3 m-auto">
                    <h5 class="text-center">Đặt hàng</h5>
                    <form method="post" action="{{ route('orderLive') }}" enctype="multipart/form-data" id="form_order1">
                        @csrf
                        <div class="row justify-content-center mb-3">
                            <div class="form-check col-4">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="home"
                                    value="0" checked>
                                <label class="form-check-label" for="home">
                                    Giao hàng tận nơi
                                </label>
                            </div>
                            <div class="form-check col-4">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="give"
                                    value="1">
                                <label class="form-check-label" for="give">
                                    Đến nhận hàng
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="serviceTypeCode" value="{{ $detailService->service_type_code }}">
                        <input type="hidden" name="serviceTypeName" value="{{ $detailService->service_type_name }}"
                            id="serviceTypeName">
                        <input type="hidden" name="currency1" value="{{ $detailService->price }}" id="currency1">
                        <input type="hidden" name="completeTime" value="2" id="completeTime">
                        <input type="hidden" name="idUser" value="{{ Auth::user()->id }}">
                        <div id="infor">
                            <div class="mb-3">
                                <label for="" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" name="address"id="address">
                            </div>
                            @error('address')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="sdt" class="form-label">Số điện thoại</label>
                                <input type="phone" class="form-control" name="sdt" id="sdt">
                            </div>

                            @error('sdt')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="address-company">
                            <div class="mb-3 border border-success rounded bg-body-secondary text-success p-3">
                                <p class="fw-bold">VĂN PHÒNG GIAO DỊCH:</p>
                                <p>125 Điện biên phủ, Phường 15, Quận Bình Thạnh, Thành phố Hồ Chí Minh</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="content" style="height: 100px" name="content"></textarea>
                        </div>
                        @error('content')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="statusReceipt" class="form-label">Hình thức thanh toán</label>
                            <select class="form-select" aria-label="Small select example" name="statusReceipt"
                                id="statusReceipt">
                                @foreach ($statusReceipt as $row)
                                    <option value="{{ $row->status_id }}">{{ $row->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-8">
                                <label for="formFile" class="form-label">Gửi tài liệu</label>
                                <input class="form-control" type="file" id="formFile" name="files">
                                @error('files')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="quanlity" class="form-label">Số bản</label>
                                <input class="form-control" type="number" id="quantity" min="1" value="1"
                                    name="quantity">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-4">Tổng:</div>
                            <div class="col-8 fw-bold" id="sum2"> </div>
                            <input type="hidden" name="sum" id="sum1" value="">
                        </div>
                        <div class="form-text text-danger" id="message">Nếu tổng thanh toán nhỏ hơn 10.000 đ, quý khách vui lòng chọn thanh toán khi nhận hàng.</div>
                        <div class="mb-3 d-flex justify-content-center">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" id="orderButton">
                                Đặt hàng
                            </button>
                        </div>



                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="text-center fw-bold">Thông tin đặt hàng</h5>
                                        <div id="inforComfirm">
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
                                        </div>
                                        <div id="addressCompanyConfirm" class="row">
                                            <div class="col-4 py-3 bg-body-secondary">Nhận hàng tại</div>
                                            <div class="col-8 text-success p-3">
                                                <p class="fw-bold">VĂN PHÒNG GIAO DỊCH:</p>
                                                <p>125 Điện biên phủ, Phường 15, Quận Bình Thạnh, Thành phố Hồ Chí Minh</p>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Loại dịch vụ</div>
                                            <div class="col-8 p-3" id="service"></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Số bản</div>
                                            <div class="col-8 p-3" id="quantity1"></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Thời gian hoàn thành</div>
                                            <div class="col-8 p-3" id="completeTime1"></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Ghi chú</div>
                                            <div class="col-8 p-3" id="note"></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Hình thức thanh toán</div>
                                            <div class="col-8 p-3" id="statusReceipt1"></div>
                                        </div>
                                        <div class="row fw-bold ">
                                            <div class="col-4 py-3 bg-body-secondary">Tổng</div>
                                            <div class="col-8 p-3" id="sum"> </div>
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
                </div>
            @endif
        </div>

    </div>
@endsection
