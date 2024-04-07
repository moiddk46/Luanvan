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
                <form action="{{ route('updateDetailOrder') }}" method="post">
                    @csrf
                    <table class="table align-middle mb-0 bg-white table-striped mt-5">
                        <thead class="bg-light">
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <td>{{ $item->order_id }}</td>
                                    <input type="hidden" value="{{ $item->order_id }}" name="orderId">
                                </tr>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th>Loại dịch vụ</th>
                                    <td>{{ $item->service_type_name }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày đặt hàng</th>
                                    <td id="date">{{ $item->order_date }}</td>
                                </tr>
                                <tr>
                                    <th>Số lượng</th>
                                    <td>{{ $item->quantity }} Bản</td>
                                </tr>
                                <tr>
                                    <th>Tài liệu</th>
                                    <td>{{ $item->order_file_name }}</td>
                                </tr>
                                <tr>
                                    <th>Tổng giá</th>
                                    <td id="currency">{{ $item->unit_price }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <select id="statusSelect" class="form-select form-select-md w-50"
                                            aria-label="Small select example">
                                            <option value="{{ $item->status_id }}">{{ $item->status }}</option>
                                            @foreach ($status as $row)
                                                <option value="{{ $row->status_id }}">{{ $row->status }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="statusValue" name="status" value="{{ isset($item->status_id) ? $item->status_id : '' }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phân công</th>
                                    <td> <select id="staff" class="form-select form-select-md w-50"
                                            aria-label="Small select example">
                                            @if (isset($item->id))
                                                {
                                                <option value="{{ $item->id }}">{{ $item->nameStaff }}</option>
                                                }
                                            @else
                                                <option selected>Chọn nhân viên</option>
                                            @endif
                                            @foreach ($listStaff as $row)
                                                @if ($item->id == $row->id)
                                                    continue;
                                                @else
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="staffValue" name="staff" value="{{ isset($item->id) ? $item->id : '' }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('orderAdmin') }}" class="btn btn-secondary me-2">Quay
                            lại</a>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
