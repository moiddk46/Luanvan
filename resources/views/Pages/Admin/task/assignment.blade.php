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
                <table class="table align-middle mb-0 bg-white mt-5">
                    <thead class="bg-light">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên dịch vụ</th>
                            <th>Đơn giá</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái đơn hàng</th>
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
                                <td id="currency">
                                    {{ $item->total_price }}
                                </td>
                                <td id="date">
                                    {{ $item->order_date }}
                                </td>
                                <td>
                                    <span
                                        class="badge @if ($item->status_id == '1') text-bg-warning
                                        @elseif($item->status_id == '2')
                                            text-bg-primary
                                        @elseif($item->status_id == '3')
                                            text-bg-secondary
                                        @else
                                            text-bg-success @endif rounded-pill d-inline">{{ $item->status }}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-dark">
                                        Chi tiết
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <p>Chưa có đơn hàng nào để phân công</p>
            @endif

        </div>
    </div>
@endsection
