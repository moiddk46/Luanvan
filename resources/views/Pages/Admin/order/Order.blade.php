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
        @else
            @error('status')
                <div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 1050;">
                    <div id="myToast"
                        class="toast align-items-center {{ session('status') == true ? 'text-bg-success' : 'text-bg-danger' }}"
                        role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ $message }}
                            </div>
                        </div>
                    </div>
                </div>
            @enderror
            @error('orderIds')
                <div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 1050;">
                    <div id="myToast"
                        class="toast align-items-center {{ session('status') == true ? 'text-bg-success' : 'text-bg-danger' }}"
                        role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ $message }}
                            </div>
                        </div>
                    </div>
                </div>
            @enderror
        @endif
        <div class="row">
            @if (isset($data))
                <form action="{{ route('updateStatus') }}" method="post">
                    @csrf
                    <div class="col-6 row mt-5 mb-3">
                        <div class="col-6">
                            <select id="statusSelect" class="form-select form-select-md" aria-label="Small select example">
                                <option selected>Chọn trạng thái đơn hàng</option>
                                @foreach ($status as $row)
                                    <option value="{{ $row->status_id }}">{{ $row->status }}</option>
                                @endforeach
                            </select>

                            <input type="hidden" id="statusValue" name="status" value="">
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-success">Xác nhận đơn hàng</button>
                        </div>
                    </div>
                    <table class="table align-middle mb-0 bg-white table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>
                                    <input type="checkbox" class="btn-check checkAll" id="btn-check-outlined"
                                        autocomplete="off">
                                    <label class="btn btn-outline-success" for="btn-check-outlined">Chọn tất cả</label>
                                </th>
                                <th>Mã đơn hàng</th>
                                <th>Tên dịch vụ</th>
                                <th>Ngày đặt hàng</th>
                                <th>Trạng thái đơn hàng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        <input class="border border-dark check" type="checkbox" name="orderIds[]"
                                            {{ in_array($item->order_id, old('orderIds', [])) ? 'checked' : '' }}
                                            {{ $item->status_id == '4' ? 'disabled' : '' }}
                                            value="{{ $item->order_id }}|{{ $item->id_user }}">
                                    </td>
                                    <td>
                                        {{ $item->order_id }}
                                    </td>
                                    <td>
                                        {{ $item->service_type_name }}
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
                                        <a href="{{ route('detailOrder', ['data' => $item->order_id]) }}"
                                            class="btn btn-outline-dark">
                                            Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </form>
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
                <p class="mt-5 text-center">Chưa có đơn hàng nào.</p>
            @endif

        </div>
    </div>
@endsection
