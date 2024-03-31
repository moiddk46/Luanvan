@extends('Layouts.User.MasterLayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 px-0 box-img">
                <img src="{{ asset('assets/images/service_main_page.jpg') }}" alt="error img">
            </div>
        </div>
    </div>

    {{--  @if (isset($serviceName) && $serviceName == "Dich thuật")
        <div class="container pt-5">
            <h3 class="text-center">Dịch tự động từ google</h3>
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3 position-inline">
                        <button type="button" class="btn btn-outline-primary">Tiếng Việt</button>
                        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tiếng Việt</a></li>
                            <li><a class="dropdown-item" href="#">Tiếng Anh</a></li>
                            <li><a class="dropdown-item" href="#">Tiếng Pháp</a></li>
                        </ul>
                        <textarea class="form-control" id="lang" rows="4" cols="1"
                            aria-label="Text input with segmented dropdown button">
                    </textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3 position-inline">
                        <button type="button" class="btn btn-outline-primary">Tiếng Anh</button>
                        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tiếng Anh</a></li>
                            <li><a class="dropdown-item" href="#">Tiếng Pháp</a></li>
                            <li><a class="dropdown-item" href="#">Tiếng Việt</a></li>
                        </ul>
                        <textarea class="form-control" id="langed" rows="4" cols="1"
                            aria-label  ="Text input with segmented dropdown button">
                    </textarea>
                    </div>
                </div>
            </div>
        </div>
    @endif  --}}


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
                            <p>{{ $row->service_type_detail }}</p>
                            <a class="btn btn-outline-primary"
                                href="{{ route('detailService', ['data' => $row->service_type_code]) }}">Xem báo giá</a>
                        </div>
                    @else
                        <div class="col-7 px-5">
                            <h3 class="fw-bold mb-3">{{ $row->service_type_name }}</h3>
                            <p>{{ $row->service_type_detail }}</p>
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
