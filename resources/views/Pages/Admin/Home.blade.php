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
        <div class="row py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-xl-5">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Đơn hàng</h6>
                                <h2 class="text-right"><i class="bi bi-cart4"></i></i><span class="ms-3"
                                        id="countOrder">0</span></h2>
                                <p class="m-b-0">Đơn hàng đã hoàn thành<span class="f-right" id="orderComplete">0</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-5">
                        <div class="card bg-c-green order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Khách hàng</h6>
                                <h2 class="text-right"><i class="bi bi-person"></i><span class="ms-3"
                                        id="countCustomer">0</span></h2>
                                <p class="m-b-0">Khách hàng đã đặt hàng<span class="f-right" id="userOrder">0</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-5">
                        <div class="card bg-c-yellow order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Nhân viên</h6>
                                <h2 class="text-right"><i class="bi bi-person-workspace"></i><span class="ms-3"
                                        id="countStaff">0</span></h2>
                                <p class="m-b-0">Nhân viên đã hoàn thành nhiệm vụ<span class="f-right"
                                        id="taskComplete">0</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xl-5">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Doanh thu</h6>
                                <h2 class="text-right"><i class="bi bi-cash"></i><span class="ms-3"
                                        id="sumPrice">0</span></h2>
                                <p class="m-b-0">Đơn hàng đã thanh toán<span class="f-right" id="receiptComplete">0</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="row justify-content-center w-50 m-auto mb-3">
                    <div class="col-6">
                        <select id="year" class="form-select">
                            @for ($i = 2024; $i >= 2020; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-6 align-content-end">
                        <button id="exportDataBtn" class="btn btn-success">Xuất Dữ Liệu</button>

                    </div>
                </div>
                <canvas id="myChart" class="w-75 h-75 m-auto"></canvas>
            </div>
        </div>

    </div>
@endsection
