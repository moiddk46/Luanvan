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
            <h5>Danh sách giỏ hàng</h5>
            @if (isset($data) && !empty($data))
                <table class="table align-middle mb-0 bg-white">
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
                                        {{ $item->status_id == '4' ? 'disabled' : '' }} value="{{ $item->order_id }}">
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
