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
            <div class="w-50 border border-light rounded bg-dark-subtle p-3 m-auto">
                <h5 class="text-center">Yêu cầu báo giá</h5>
                <form method="post" action="{{ route('priceRequest') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="serviceTypeCode" value="{{ $detailService->service_type_code }}">
                    <div class="mb-3">
                        <label for="" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    @error('name')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    @error('address')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Số điện thoại</label>
                        <input type="phone" class="form-control" name="sdt">
                    </div>
                    @error('sdt')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="content" style="height: 100px" name="content"></textarea>
                    </div>
                    @error('content')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Gửi tài liệu</label>
                        <input class="form-control" type="file" id="formFile" name="files">
                        @error('files')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <button class="btn btn-success">Đặt hàng</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
