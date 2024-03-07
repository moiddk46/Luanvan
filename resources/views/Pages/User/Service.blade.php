@extends('Layouts.MasterLayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 px-0 box-img">
                <img src="{{ asset('assets/images/service_main_page.jpg') }}" alt="error img">
            </div>
        </div>
    </div>

    <div class="container pt-5">
        <h3 class="text-center">Dịch tự động từ google</h3>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3 position-inline">
                    <button type="button" class="btn btn-outline-primary">Tiếng Việt</button>
                    <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Tiếng Việt</a></li>
                        <li><a class="dropdown-item" href="#">Tiếng Anh</a></li>
                        <li><a class="dropdown-item" href="#">Tiếng Pháp</a></li>
                    </ul>
                    <textarea class="form-control" id="lang" rows="4" cols="1" aria-label="Text input with segmented dropdown button">
                    </textarea>
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3 position-inline">
                    <button type="button" class="btn btn-outline-primary">Tiếng Anh</button>
                    <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Tiếng Anh</a></li>
                        <li><a class="dropdown-item" href="#">Tiếng Pháp</a></li>
                        <li><a class="dropdown-item" href="#">Tiếng Việt</a></li>
                    </ul>
                    <textarea class="form-control" id="langed" rows="4" cols="1"
                        aria-label  ="Text input with segmented dropdown button">
                    </textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-7 px-5">
                <h3 class="fw-bold mb-3">Dịch thuật công chứng</h3>
                <p>Dịch tài liệu từ tiếng Việt sang ngôn ngữ khác
                    hoặc ngược lại có công chứng trong thời gian nhanh nhất.
                    Dịch thuật 24h tự hào luôn nắm kịp thời những quy định mới nhất của các lãnh sự quán,
                    cơ quan nhà nước</p>
                <button class="btn btn-outline-primary">Xem báo giá</button>
            </div>
            <div class="col-5">
                <img class="w-75 h-75 rounded rounded-5" src="{{ asset('assets/images/img_dichthuatcongchung.jpg') }}"
                    alt="no image">
            </div>
        </div>


    </div>
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-5">
                <img class="w-75 h-75 rounded rounded-5" src="{{ asset('assets/images/image_dichthuatthongthuong.jpg') }}"
                    alt="no image">
            </div>
            <div class="col-7 px-5">
                <h3 class="fw-bold mb-3">Dịch thuật thông thường</h3>
                <p>Dịch thuật tới gần 100 ngôn ngữ trên khắp thế giới.
                    Tất cả quy trình có thể xử lý online mà không cần phải tới văn phòng.</p>
                <button class="btn btn-outline-primary">Xem báo giá</button>
            </div>
        </div>
    </div>
@endsection
