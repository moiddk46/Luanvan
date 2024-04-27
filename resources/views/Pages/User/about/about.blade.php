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
            <div class="row mb-3">
                <img class="" style="height: 500px" src="{{ asset('assets/images/logo.jpg') }}" alt="khong co anh">
            </div>
            <div class="row">
                <p>TranslateGroup tự hào là một công ty có bề dày hoạt động lâu năm và giàu kinh nghiệm trong
                    lĩnh vực dịch
                    thuật công chứng. Được thành lập vào năm 2006, trải qua gần 20 năm hoạt động và phát triển,
                    TranslateGroup
                    không ngừng nâng cao và đổi mới để đem đến cho khách hàng những dịch vụ và sản phẩm chất lượng nhất.
                </p>
            </div>
            <div class="row mb-3">
                <h4>Các dịch vụ của TranslateGroup</h4>
                <ul class="ms-4 ">
                    <li>Dịch thuật đa ngôn ngữ</li>
                    <li>In ấn tài liệu</li>
                    <li>Photocopy</li>
                </ul>
            </div>
            <div class="row mb-3">
                <img class="" style="height: 500px" src="{{ asset('assets/images/1713952388_CONG-CHUNG.png') }}"
                    alt="khong co anh">
            </div>
            <div class="row mb-3">
                <h4>Lý do chọn chúng tôi</h4>
                <ul class="ms-4">
                    <li>Chi phí cạnh tranh trên thị trường.</li>
                    <li>Đội ngũ nhân viên chuyên nghiệp, tỉ mỉ, sẵn sàng phục vụ khách hàng 24/7.</li>
                    <li>Đội ngũ dịch thuật viên, phiên dịch viên giàu kinh nghiệm, có thể thông dịch thành thạo 50 ngôn
                        ngữ và 100 lĩnh vực khác nhau.</li>
                    <li>Thời gian hoàn thiện nhanh chóng, hạn chế tối đa các thủ tục rườm ra cho khách hàng.</li>
                </ul>
            </div>
            <div class="row mb-3">
                <img style="height: 500px"
                    src="{{ asset('assets/images/service_main_page.2jpg.jpg') }}" alt="khong co anh">
            </div>
            <div class="row mb-3">
                <h4>Cam kết của chúng tôi</h4>
                <p>Bằng uy tín gần 20 năm của mình, TranslateGroup tự hào cung cấp dịch vụ tốt nhất, chuyên nghiệp nhất và
                    đảm bảo sự hài lòng tuyệt đối cho quý khách hàng. Chúng tôi cam kết là lựa chọn tối ưu cho các đối tác
                    và doanh nghiệp có nhu cầu dịch thuật công chứng, phiên dịch và hợp pháp hoá lãnh sự.</p>
            </div>
        </div>
    </div>
@endsection
