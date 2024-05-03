@extends('Layouts.Staff.MasterLayout')

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
        <div class="container-fluid pt-2">
            <h3 class="text-center mt-5 mb-3 fw-bold">Danh sách nhiệm vụ</h3>
            <div class="row">
                <div class="d-flex col-9">
                    <div class="me-2">
                        <input type="radio" class="btn-check" name="options-base" id="allTask" autocomplete="off"
                            checked>
                        <label class="btn btn-outline-success" for="allTask">Tất cả</label>
                    </div>
                    <div class="me-2">
                        <input type="radio" class="btn-check" name="options-base" id="done" autocomplete="off">
                        <label class="btn btn-outline-success" for="done">Đã làm</label>
                    </div>
                    <div>
                        <input type="radio" class="btn-check" name="options-base" id="donot" autocomplete="off">
                        <label class="btn btn-outline-success" for="donot">Chưa làm</label>
                    </div>
                </div>
                <div class="col-3">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm nhiệm vụ" id="searchTask"
                        aria-label="Search">
                    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                </div>
            </div>
            @if (isset($data))
                <table class="table align-middle mb-0 bg-white mt-5 table-striped" id="table-task">
                    <thead class="bg-light">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Loại dịch vụ</th>
                            <th>Ngày hoàn thành</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="ordersTableBody">

                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $item->order_id }}
                                </td>
                                <td>
                                    {{ $item->service_type_name }}
                                </td>
                                <td id="date">
                                    {{ $item->complete_time }}
                                </td>
                                <td id="date">
                                    {{ $item->order_date }}
                                </td>
                                <td>
                                    <span
                                        class="badge  
                                            @if ($item->status_id == '1') text-bg-warning
                                            @elseif($item->status_id == '2')
                                                text-bg-primary
                                            @elseif($item->status_id == '3')
                                                text-bg-secondary
                                            @else
                                                text-bg-success @endif
                                                rounded-pill d-inline">{{ $item->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('detailTask', ['data' => $item->order_id]) }}"
                                        class="btn btn-outline-dark">
                                        Chi tiết
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
                </div>
            @else
                <p>Chưa nhiệm vụ nào.</p>
            @endif

        </div>
    </div>
@endsection
