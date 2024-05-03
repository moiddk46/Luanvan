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
            <div class="row">
                <div class="col-8 mt-5">
                    <a href="{{ route('addPriceRequest') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Thêm
                        yêu
                        cầu báo giá </a>
                </div>
                <div class="col-4 justify-content-end mt-5 mb-3">
                    <input class="form-control me-2" type="search" id="searchPriceRequest" placeholder="Tìm kiếm yêu cầu báo giá"
                        aria-label="Search">
                </div>
            </div>
            @if (isset($data))
                <table class="table align-middle mb-0 bg-white mt-2 table-striped" id="priceRequestTable">
                    <thead class="bg-light">
                        <tr>
                            <th>Mã báo giá</th>
                            <th>Tên dịch vụ</th>
                            <th>Ngày yêu cầu</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $item->request_id }}
                                </td>
                                <td>
                                    {{ $item->service_type_name }}
                                </td>
                                <td id="date">
                                    {{ $item->request_date }}
                                </td>
                                <td>
                                    <span
                                        class="badge  
                                            @if ($item->status_id == '2') text-bg-warning
                                            @else
                                                text-bg-success @endif
                                                rounded-pill d-inline">{{ $item->status }}</span>
                                </td>
                                <td>
                                    <!-- Liên kết kích hoạt modal -->
                                    <!-- Nút Trả lời -->
                                    <a href="{{ route('detailPriceRequest', ['data' => $item->request_id]) }}"
                                        class="btn btn-outline-dark">
                                        Trả lời
                                    </a>

                                    <!-- Nút Xóa -->
                                    <a href="{{ route('deletePriceRequest', ['data' => $item->request_id]) }}"
                                        class="btn btn-outline-danger modalTrigger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-action="delete"
                                        data-request-id="{{ $item->request_id }}">
                                        Xóa
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    <ul class="pagination">

                        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                            @if ($page == $data->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a href="{{ $url }}"
                                        class="page-link">{{ $page }}</a></li>
                            @endif
                        @endforeach

                    </ul>
                </div>
            @else
                <p>Chưa có yêu cầu nào.</p>
            @endif

        </div>
    </div>
@endsection
