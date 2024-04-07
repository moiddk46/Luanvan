@extends('Layouts.User.MasterLayout')

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
        <div class="row p-5">
            <div class="col-7 row align-items-center">
                <div class="textcotent">
                    <p class="fs-1 fw-bold">Công ty chúng tôi có gì?</p>
                    <p class="fs-3">Chúng tôi tự tin với các dịch vụ đang phục vụ khách hàng hiện tại như
                        in ấn, photocopy, dịch thuật và dịch thuật công chứng. Đảm bảo chất lượng,
                        an toàn bảo mật thông tin cho khách hàng.
                    </p>
                    <div class="mt-5">
                        <x-form.quote :prop="$header" />
                    </div>
                </div>
            </div>
            <div class="col-5">
                <img class="imgHomePage" src="{{ asset('assets/images/image1.jpg') }}" alt="slider home page">
            </div>
        </div>
    </div>

    <form action="{{ route('payment') }}" method="post">
        <button type="submit">Thanh Toan</button>
    </form>
@endsection
