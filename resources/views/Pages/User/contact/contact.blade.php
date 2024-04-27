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
        <div class="container pt-5">
            <div class="row">
                <div class="col-6 form-order bg-light rounded text-success p-3">
                    <h3 class="mb-3">TranslateGroup</h3>
                    <div> 
                        <p class="fw-bold d-inline-block m-0">Địa chỉ:</p>
                        <p class="d-inline-block">125 Điện biên phủ, Phường 15, Quận Bình Thạnh, Thành phố Hồ Chí Minh</p>
                    </div>
                    <div>
                        <p class="fw-bold d-inline-block m-0">Số điện thoại:</p>
                        <p class="d-inline-block">0854 172 887</p>
                    </div>
                    <div>
                        <p class="fw-bold d-inline-block m-0">Email:</p>
                        <p class="d-inline-block">info@translategroup.com</p>
                    </div>
                    <div>
                        <p class="fw-bold d-inline-block m-0">Zalo:</p>
                        <p class="d-inline-block">0854 172 887</p>
                    </div>

                    <div>
                        <p class="fw-bold">Thời gian làm việc: Từ thứ hai đến thứ bảy</p>
                        <div class="ms-5"> <!-- Sử dụng class ms-5 từ Bootstrap để thay cho margin-left -->
                            <p>Sáng: 8h-12h</p>
                            <p>Chiều: 13h30-17h30</p>
                        </div>
                    </div>

                </div>
                <div class="col-6">
                    <iframe class="map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.1890693655782!2d106.70047367405373!3d10.79682668935317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528b6fed2747b%3A0x743a99e90228b08d!2zMTI1IMSQLiDEkGnhu4duIEJpw6puIFBo4bunLCBQaMaw4budbmcgMTUsIELDrG5oIFRo4bqhbmgsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1714207731309!5m2!1svi!2s"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
