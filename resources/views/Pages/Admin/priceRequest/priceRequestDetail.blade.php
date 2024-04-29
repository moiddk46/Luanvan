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
                <form action="{{ route('updateDetailRequest') }}" method="post">
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
                                    <th>Mã báo giá</th>
                                    <td>{{ $item->request_id }}</td>
                                    <input type="hidden" value="{{ $item->request_id }}" name="requestId">
                                </tr>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <td id="name">{{ $item->name }}</td>
                                    <input type="hidden" value="{{ $item->id }}" name="idUser">
                                </tr>
                                <tr>
                                    <th>Loại dịch vụ</th>
                                    <td id="service">{{ $item->service_type_name }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày yêu cầu</th>
                                    <td id="date">{{ $item->request_date }}</td>
                                </tr>
                                <tr>
                                    <th>Tài liệu</th>
                                    <td class="row">
                                        <span class="col-6">
                                            {{ $item->request_file }}</span>
                                        <span class="col-4 align-content-center">
                                            <a href="{{ route('download', ['data' => $item->request_id]) }}"
                                                class="btn btn-success">
                                                Tải xuống
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <select id="statusSelect" class="form-select form-select-md w-50"
                                            aria-label="Small select example">
                                            <option value="{{ $item->status_id }}">{{ $item->status }}</option>
                                            @foreach ($status as $row)
                                                @if ($item->status_id == $row->status_id)
                                                    {
                                                    continue
                                                    }
                                                @else
                                                    <option value="{{ $row->status_id }}">{{ $row->status }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="statusValue" name="status"
                                            value="{{ isset($item->status_id) ? $item->status_id : '' }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Thời gian hoàn thành</th>
                                    <td class="row">
                                        <div class="col-3 row">
                                            <div class="col">
                                                <input type="text" id="complete_time" name="completeTime"
                                                    class="form-control"
                                                    value="{{ !empty($item->complete_time) ? $item->complete_time : '' }}">
                                            </div>
                                            <div class="col pt-2">
                                                Ngày
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Số trang trong tài liệu</th>
                                    <td class="row">
                                        <div class="col-3 row">
                                            <div class="col">
                                                <input type="text" id="page" name="page"
                                                    class="form-control"
                                                    value="{{ $item->page }}">
                                            </div>
                                            <div class="col pt-2">
                                                Trang
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Báo giá</th>
                                    <td class="row">
                                        <div class="col-6 row">
                                            <div class="col">
                                                <input type="text" id="price" name="price" class="form-control"
                                                    value="{{ !empty($item->price) ? $item->price : '' }}">
                                            </div>
                                            <div class="col pt-2">
                                                VND
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trả lời báo giá</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <textarea class="form-control" id="mytext" name="content">
                                                @if (!empty($item->price_letter))
{{ $item->price_letter }}
@endif
                                                </textarea>
                                            </div>
                                            <div class="col-4 align-content-center">
                                                <button type="button" class="btn btn-success" id="sample">
                                                    Thư báo giá mẫu
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('priceRequestAdmin') }}" class="btn btn-secondary me-2">Quay
                            lại</a>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
