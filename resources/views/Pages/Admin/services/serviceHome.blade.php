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
            <div class="mt-5 ">
                <a href="{{ route('addServiceAdmin') }}" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Thêm dịch
                    vụ </a>
            </div>
            @if (isset($data))
                <table class="table align-middle mb-0 bg-white mt-2 table-striped">
                    <thead class="bg-light">
                        <tr>
                            <th>Mã dịch vụ</th>
                            <th>Tên dịch vụ</th>
                            <th>Loại dịch vụ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $item->service_type_code }}
                                </td>
                                <td>
                                    {{ $item->service_type_name }}
                                </td>
                                <td>
                                    {{ $item->service_name }}
                                </td>
                                <td>
                                    <a href="{{ route('detailServiceAdmin', ['data' => $item->service_type_code]) }}"
                                        class="btn btn-outline-dark">
                                        Chi tiết
                                    </a>
                                    <a href="{{ route('deleteService', ['data' => $item->service_type_code]) }}"
                                        class="btn btn-outline-danger modalTrigger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-action="delete">
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
                <p>Chưa dịch vụ nào.</p>
            @endif
        </div>
    </div>
@endsection
