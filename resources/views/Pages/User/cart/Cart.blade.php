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
            <h3 class="text-center mt-5 mb-3 fw-bold">Danh sách đơn hàng</h3>
            @if (isset($data) && !empty($data))
                <table class="table align-middle mb-0 bg-white table-striped">
                    <thead class="bg-light">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên dịch vụ</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $item)
                            <tr>
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
                                    <a href="{{ route('detailCart', ['data' => $item->order_id]) }}"
                                        class="btn btn-outline-dark">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <p class="mt-5 text-center">Chưa có đơn hàng nào.</p>
            @endif
        </div>

    </div>
@endsection
