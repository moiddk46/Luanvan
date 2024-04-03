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
                                            @if ($item->status_id == '5') text-bg-warning
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
            @else
                <p>Chưa có yêu cầu nào.</p>
            @endif

        </div>
    </div>
@endsection
