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
                                    <input type="hidden" value="{{ $item->id_user }}" name="idUser">
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
                                    <th>Ngày hoàn thành dự kiến</th>
                                    <td id="date">{{ $item->complete_time }} </td>
                                </tr>
                                <tr>
                                    <th>Số lượng</th>
                                    <td>{{ $item->quantity }} Bản</td>
                                </tr>
                                <tr>
                                    <th>Tài liệu</th>
                                    <td class="row">
                                        <span class="col-6">
                                            {{ $item->order_file_name }}
                                        </span>
                                        <span class="col-4 align-content-center">
                                            <a href="{{ route('downloadOrder', ['data' => $item->order_id]) }}"
                                                class="btn btn-success">
                                                Tải xuống
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Hình thức thanh toán</th>
                                    <td>{{ $item->sd_status }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái thanh toán</th>
                                    <td>
                                        @if ($item->sr_status_id == '2')
                                            <span
                                                class="badge text-bg-success rounded-pill d-inline ">{{ $item->sr_status }}</span>
                                        @else
                                            <select id="statusReceipt" class="form-select form-select-md w-50"
                                                aria-label="Small select example" name="statusReceipt">
                                                <option value="{{ $item->sr_status_id }}">{{ $item->sr_status }}</option>
                                                @foreach ($statusReceipt as $row)
                                                    @if ($item->sr_status_id == $row->status_id)
                                                        continue;
                                                    @else
                                                        <option value="{{ $row->status_id }}">{{ $row->status }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        <input type="hidden" id="statusReceiptValue" name="statusReceipt"
                                            value="{{ $item->sr_status_id }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tổng giá</th>
                                    <td id="currency">{{ $item->unit_price }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        @if ($item->status_id == '4')
                                            <span
                                                class="badge text-bg-success rounded-pill d-inline ">{{ $item->status }}</span>
                                        @else
                                            <select id="statusSelect" class="form-select form-select-md w-50"
                                                aria-label="Small select example">
                                                <option value="{{ $item->status_id }}">{{ $item->status }}</option>
                                                @foreach ($status as $row)
                                                    @if ($item->status_id == $row->status_id)
                                                        continue;
                                                    @else
                                                        <option value="{{ $row->status_id }}">{{ $row->status }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="statusValue" name="status"
                                                value="{{ isset($item->status_id) ? $item->status_id : '' }}">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phân công</th>
                                    <td>
                                        @if ($item->status_id == '4')
                                            {{ $item->nameStaff }}
                                        @else
                                            <select id="staff" class="form-select form-select-md w-50"
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
                                            <input type="hidden" id="staffValue" name="staff"
                                                value="{{ isset($item->id) ? $item->id : '' }}">
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('orderAdmin') }}" class="btn btn-secondary me-2">Quay
                            lại</a>
                        @if ($item->status_id != '4')
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        @endif
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
