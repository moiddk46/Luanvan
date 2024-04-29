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
            <form action="{{ route('initPriceRequest') }}" method="post" enctype="multipart/form-data">
                @csrf
                <table class="table align-middle mb-0 bg-white mt-5 table-striped">
                    <thead>
                        <tr>
                            <th class="w-25">Tiêu đề</th>
                            <th>Nội dung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Tên khách hàng</th>
                            <td><input class="form-control w-50" type="text" name="name"></td>
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td><input class="form-control w-50" type="text" name="address"></td>
                            @error('address')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </tr>
                        <tr>
                            <th>Số điện thoại</th>
                            <td><input class="form-control w-50" type="number" name="sdt"></td>
                            @error('sdt')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </tr>
                        <tr>
                            <th>Loại dịch vụ</th>
                            <td> <select id="service" class="form-select form-select-md w-50"
                                    aria-label="Small select example" name="serviceTypeCode">
                                    @foreach ($serviceType as $row)
                                        <option value="{{ $row->service_type_code }}">{{ $row->service_type_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('serviceTypeCode')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <th>Nội dung</th>
                            <td>
                                <textarea class="form-control w-50" id="content" style="height: 100px" name="content" id="content"
                                    placeholder="Mẫu: Hãy báo giá dịch thuật tài liệu này giúp tôi,...."></textarea>
                            </td>
                            @error('content')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </tr>
                        <tr>
                            <th>Tài liệu</th>
                            <td class="row">
                                <div class="col-6">
                                    <label for="formFile" class="form-label">Gửi tài liệu</label>
                                    <input class="form-control" type="file" id="formFile" name="files"
                                        placeholder="Chọn file">
                                    @error('files')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <label for="page" class="form-label">Số trang trong tài liệu</label>
                                    <input class="form-control" type="number" id="page" min="1" value="1"
                                        name="page">
                                    @error('page')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('priceRequestAdmin') }}" class="btn btn-secondary me-2">Quay
                        lại</a>
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
