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
            <a href="https://zalo.me/0854172887" class="btn btn-primary" target="_blank">Liên hệ qua Zalo</a>
            <div class="row mb-3">
                <div class="col-7 row align-items-center">
                    <div class="textcotent">
                        <p class="fs-1 fw-bold">Công ty chúng tôi có gì?</p>
                        <p class="fs-3">Chúng tôi tự tin với các dịch vụ đang phục vụ khách hàng hiện tại như
                            in ấn, photocopy, dịch thuật và dịch thuật công chứng. Đảm bảo chất lượng,
                            an toàn bảo mật thông tin cho khách hàng.
                        </p>
                    </div>
                </div>
                <div class="col-5">
                    <img class="imgHomePage" src="{{ asset('assets/images/image1.jpg') }}" alt="slider home page">
                </div>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col text-center">
                    <div><i class="bi bi-buildings fs-1"></i></div>
                    <div>Chúng tôi có đội ngũ nhân viên được đào tạo chuyên môn nghiệp vụ cao</div>
                </div>
                <div class="col text-center">
                    <div><i class="bi bi-box fs-1"></i></div>
                    <div>Chất lượng dịch vụ hàng đầu trong lĩnh vực này.</div>
                </div>
                <div class="col text-center">
                    <div><i class="bi bi-bookmark-star fs-1"></i></div>
                    <div>Dịch vụ của chúng tôi được đảm bào bởi hiệp hội quốc tế</div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-5">
                    <img class="w-75 h-75 rounded rounded-5" src="{{ asset('assets/images/dichvu.jpg') }}" alt="no image">
                </div>
                <div class="col-7 px-5">
                    <h3 class="mb-3">Dịch vụ công ty</h3>
                    <p>TranslateGroup mang đến cho các khách hàng các loại dịch vụ như: Dịch thuật đa ngôn ngữ, lĩnh vực,
                        dịch vụ in ấn tài liệu, photo tài liệu , ... với mức giá ưu đãi và đảm bảo chất lượng cho khách
                        hàng.</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-7 px-5">
                    <h3 class="mb-3">Chất lượng dịch vụ</h3>
                    <p>Bằng uy tín gần 20 năm của mình, TranslateGroup tự hào cung cấp dịch vụ tốt nhất, chuyên nghiệp nhất
                        và đảm bảo sự hài lòng tuyệt đối cho quý khách hàng. Chúng tôi cam kết là lựa chọn tối ưu cho các
                        đối tác và doanh nghiệp có nhu cầu dịch thuật công chứng, phiên dịch và hợp pháp hoá lãnh sự.</p>
                </div>
                <div class="col-5">
                    <img class="w-75 h-75 rounded rounded-5" src="{{ asset('assets/images/chatluong.jpg') }}"
                        alt="no image">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-5">
                    <img class="w-75 h-75 rounded rounded-5" src="{{ asset('assets/images/thanhtuu.jpg') }}" alt="no image">
                </div>
                <div class="col-7 px-5">
                    <h3 class="mb-3">Thành tựu</h3>
                    <p>TranslateGroup tự hào là một
                        công ty có bề dày hoạt động lâu năm và giàu kinh nghiệm trong lĩnh vực dịch thuật công chứng. Được
                        thành lập vào năm 2006, trải qua gần 20 năm hoạt động và phát triển, TranslateGroup không ngừng nâng
                        cao và đổi mới để đem đến cho khách hàng những dịch vụ và sản phẩm chất lượng nhất. </p>
                </div>
            </div>
        </div>
    </div>
@endsection
