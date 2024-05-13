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
            @if (isset($data))
                <form action="{{ route('updateDetailServiceAdmin') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <table class="table align-middle mb-0 bg-white mt-5 table-striped">
                        <thead>
                            <tr>
                                <th class="w-25">Tiêu đề</th>
                                <th>Nội dung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <th>Mã dịch vụ</th>
                                    <td>{{ $item->service_type_code }}
                                        <input class="form-control" type="hidden" name="serviceTypeCode"
                                            value="{{ $item->service_type_code }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tên dịch vụ</th>
                                    <td>
                                        <input class="form-control" type="text" name="serviceTypeName"
                                            value="{{ $item->service_type_name }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Loại dịch vụ</th>
                                    <td>
                                        <select id="serviceCode" class="form-select form-select-md"
                                            aria-label="Small select example" name="serviceCode">
                                            <option value="{{ $item->service_code }}">{{ $item->service_name }}
                                            </option>
                                            @foreach ($serviceMaster as $row)
                                                @if ($item->service_code == $row->service_code)
                                                    continue
                                                @else
                                                    <option value="{{ $row->service_code }}">{{ $row->service_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Thông tin dịch vụ</th>
                                    <td>
                                        <textarea id="mytext" name="detailService">{{ $item->service_type_detail }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Thông tin báo giá</th>
                                    <td>
                                        <textarea id="mytext" name="detailPrice">{{ $item->detail_price }}</textarea>
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
                                                src="{{ asset('assets/images/' . $item->img) }}" id="displayImage"
                                                alt="no image">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giá</th>
                                    <td class="row">
                                        <div class="col-lg-2 col-md-4 col-sm-4">
                                            <input class="form-control" type="number" id="price" name="price"
                                                value="{{ $item->price }}" min="1">
                                        </div>
                                        <div class="col align-content-center">
                                            VND
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('allService') }}" class="btn btn-secondary me-2">Quay
                            lại</a>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
