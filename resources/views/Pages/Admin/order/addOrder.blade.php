    @extends('Layouts.Admin.MasterLayout')

    @section('content')
        <div class="border border-light px-5">
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
            <div class="row">
                <form action="{{ route('addOrderAdmin') }}" method="post" enctype="multipart/form-data" id="form_order3">
                    @csrf
                    <table class="table align-middle mb-0 bg-white table-striped mt-5">
                        <thead class="bg-light">
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" name="requestId" value="{{ md5(rand(10, 100)) }}">
                            <tr>
                                <th>Loại dịch vụ</th>
                                <td><select id="serviceTypeCode" class="form-select form-select-md w-50"
                                        aria-label="Small select example" name="serviceTypeCode">
                                        <option checked>Chọn dịch vụ</option>
                                        @foreach ($serviceType as $row)
                                            <option value="{{ $row->service_type_code }}">{{ $row->service_type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr id="inforRequest">
                                <th>Tên khách hàng</th>
                                <td><input class="form-control w-50" type="text" id="name" name="name"></td>
                            </tr>
                            <tr id="inforRequest1">
                                <th>Địa chỉ</th>
                                <td><input class="form-control w-50" type="text" id="address" name="address"></td>
                            </tr>
                            <tr id="inforRequest2">
                                <th>Số điện thoại</th>
                                <td><input class="form-control w-50" type="number" name="sdt" id="sdt"></td>
                            </tr>
                            <tr>
                            <tr>
                                <th>Thời gian hoàn thành</th>
                                <td class="row">
                                    <div class="col-2">
                                        <input class="form-control" type="number" name="completeTime" id="completeTime"
                                            value="1">
                                    </div>
                                    <div class="col-4  align-content-center ">
                                        Ngày( Bắt
                                        đầu từ ngày đặt hàng)
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Số lượng</th>
                                <td class="row">
                                    <div class="col-2">
                                        <input class="form-control" type="number" min="1" name="quantity"
                                            id="quantity" value="1">
                                    </div>
                                    <div class="col-1 align-content-center">
                                        Bản
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Giá</th>
                                <td class="row">
                                    <div class="col-2">
                                        <input class="form-control" type="number" min="1" name="priceService"
                                            id="currency1" value="1">
                                    </div>
                                    <div class="col-1 align-content-center">
                                        đ
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Tài liệu</th>
                                <td class="row">
                                    <div class="col-6">
                                        <label for="formFile" class="form-label">Gửi tài liệu</label>
                                        <input class="form-control" type="file" id="formFile" name="files"
                                            placeholder="Chọn file">
                                    </div>
                                    <div class="col-3">
                                        <label for="page" class="form-label">Số trang trong tài liệu</label>
                                        <input class="form-control" type="number" id="page" min="1"
                                            value="1" name="page">
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th>Hình thức thanh toán</th>
                                <td>
                                    <select id="statusReceipt" class="form-select form-select-md w-50"
                                        aria-label="Small select example" name="statusReceipt">
                                        @foreach ($statusReceipt as $row)
                                            <option value="{{ $row->status_id }}">{{ $row->status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Tổng giá</th>
                                <td id="sum" class="fw-bold"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('orderAdmin') }}" class="btn btn-secondary me-2">Quay
                            lại</a>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Xác nhận
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
                                        <div class="col-8 p-3" id="service2"></div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4 py-3 bg-body-secondary">Số bản</div>
                                        <div class="col-8 p-3" id="quantity1"></div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4 py-3 bg-body-secondary">Số trang trong tài liệu</div>
                                        <div class="col-8 p-3" id="page1"></div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4 py-3 bg-body-secondary">Thời gian hoàn thành</div>
                                        <div class="col-8 p-3" id="completeTime1"></div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-4 py-3 bg-body-secondary">Hình thức thanh toán</div>
                                        <div class="col-8 p-3" id="statusReceipt1"></div>
                                    </div>
                                    <div class="row fw-bold ">
                                        <div class="col-4 py-3 bg-body-secondary">Tổng</div>
                                        <div class="col-8 p-3" id="sum2"> </div>
                                        <input type="hidden" name="sum" id="sum1" value="">
                                    </div>
                                </div>
                                <div class="modal-footer m-auto">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-success" name="redirect" id="button">Xác
                                        nhận</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
