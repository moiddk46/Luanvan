@extends('Layouts.Staff.MasterLayout')

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
        <div class="col-5 m-auto align-content-center">
            <div class="card bg-c-blue order-card mt-5">
                <div class="card-block">
                    <h6 class="m-b-20">Nhiệm vụ</h6>
                    <h2 class="text-right"><i class="bi bi-person-workspace"></i></i><span class="ms-3"
                            id="countTask">0</span>
                    </h2>
                    <p class="m-b-0">Nhiệm vụ đã hoàn thành<span class="f-right" id="staffComplete">0</span>
                        <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                    </p>
                </div>
            </div>
        </div>
        <div class="row p-5">
            <div class="col-7 row align-items-center">
                <div class="textcotent">
                    <p class="fs-1 fw-bold">Trách nhiệm với công việc là ưu tiên hàng đầu</p>
                    <p class="fs-3">Đảm bảo đúng hạng giao hàng, không lơ là, tận tụy, hết mình với công việc là phương
                        châm của công ty chúng ta
                    </p>
                </div>
            </div>
            <div class="col-5">
                <img class="imgHomePage" src="{{ asset('assets/images/nhanvien.jpg') }}" alt="slider home page">
            </div>
        </div>
    </div>
@endsection
