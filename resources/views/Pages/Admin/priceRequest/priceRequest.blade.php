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
                <table class="table align-middle mb-0 bg-white mt-5 table-striped">
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
                                    <a href="{{ route('detailPriceRequest', ['data' => $item->request_id]) }}"
                                        class="btn btn-outline-dark">
                                        Trả lời
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    <ul class="pagination">
                        @if ($data->onFirstPage())
                            <li class="page-item disabled"><span class="page-link prev"><i
                                        class="bi bi-arrow-left-circle"></i></span></li>
                        @else
                            <li class="page-item"><a href="{{ $data->previousPageUrl() }}" class="page-link"
                                    aria-label="Previous"><i class="bi bi-arrow-left-circle"></i></a></li>
                        @endif

                        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                            @if ($page == $data->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a href="{{ $url }}"
                                        class="page-link">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($data->hasMorePages())
                            <li class="page-item"><a href="{{ $data->nextPageUrl() }}" class="page-link"
                                    aria-label="Next"><i class="bi bi-arrow-right-circle"></i></a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link"><i
                                        class="bi bi-arrow-right-circle"></i></span></li>
                        @endif
                    </ul>
                </div>
            @else
                <p>Chưa có yêu cầu nào.</p>
            @endif

        </div>
    </div>
@endsection
