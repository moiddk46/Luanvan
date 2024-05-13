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
            <form action="{{ route('insertService') }}" method="post" enctype="multipart/form-data">
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
                            <th>Mã dịch vụ</th>
                            <td><input type="text" class="form-control" name="serviceCode"></td>

                        </tr>
                        <tr>
                            <th>Tên dịch vụ</th>
                            <td><input type="text" class="form-control" name="serviceTypeName"></td>
                        </tr>
                        <tr>
                            <th>Loại dịch vụ</th>
                            <td>
                                <div class="col-6">
                                    <select id="serviceName" class="form-select form-select-md"
                                        aria-label="Small select example" name="serviceName">
                                        <option selected>Chọn loại dịch vụ</option>
                                        @foreach ($data as $row)
                                            <option value="{{ $row->service_code }}">{{ $row->service_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Thông tin dịch vụ</th>
                            <td>
                                <textarea id="mytext" name="detailService"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Thông tin báo giá</th>
                            <td>
                                <textarea id="mytext" name="detailPrice"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Hình ảnh</th>
                            <td class="row">
                                <div class="col-6 align-content-center">
                                    <input class="form-control" type="file" id="formFile" name="files">
                                </div>
                                <div class="col-4">
                                    <img class="rounded rounded-5 m-auto col-4" style="width: 300px; height: 150px;"
                                        src="" id="displayImage" alt="no image">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Giá</th>
                            <td class="row">
                                <div class="col-2">
                                    <input class="form-control" type="number" id="price" name="price" min="1">
                                </div>
                                <div class="col align-content-center">
                                    VND
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('allService') }}" class="btn btn-secondary me-2">Quay
                        lại</a>
                    <button type="submit" class="btn btn-success">Thêm</button>
                </div>
            </form>
        </div>
    </div>
@endsection
