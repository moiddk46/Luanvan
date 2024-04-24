@extends('Layouts.User.MasterLayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 px-0 box-img">
                <img src="{{ asset('assets/images/service_main_page.jpg') }}" alt="error img">
            </div>
        </div>
    </div>
    @if (isset($service))
        @foreach ($service as $key => $row)
            <div class="container pt-5">
                <div class="row justify-content-center">
                    @if ($key % 2 == 0)
                        <div class="col-5">
                            <img class="w-75 h-75 rounded rounded-5" src="{{ asset('assets/images/' . $row->img) }}"
                                alt="no image">
                        </div>
                        <div class="col-7 px-5">
                            <h3 class="fw-bold mb-3">{{ $row->service_type_name }}</h3>
                            <p>{!! $row->service_type_detail !!}</p>
                            <a class="btn btn-outline-primary"
                                href="{{ route('detailService', ['data' => $row->service_type_code]) }}">Xem báo giá</a>
                        </div>
                    @else
                        <div class="col-7 px-5">
                            <h3 class="fw-bold mb-3">{{ $row->service_type_name }}</h3>
                            <p>{!! $row->service_type_detail !!}</p>
                            <a class="btn btn-outline-primary"
                                href="{{ route('detailService', ['data' => $row->service_type_code]) }}">Xem báo giá</a>
                        </div>
                        <div class="col-5">
                            <img class="w-75 h-75 rounded rounded-5" src="{{ asset('assets/images/' . $row->img) }}"
                                alt="no image">
                        </div>
                    @endif

                </div>


            </div>
        @endforeach
    @endif
@endsection
