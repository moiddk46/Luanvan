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
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Ngày tham gia</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td id="date">
                                    {{ $item->created_at }}
                                </td>
                                <td>
                                    <a href="" class="btn btn-outline-dark">
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

                    </ul>
                </div>
            @else
                <p>Chưa dịch vụ nào.</p>
            @endif

        </div>
    </div>
@endsection
