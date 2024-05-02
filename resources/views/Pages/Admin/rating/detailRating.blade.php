@extends('Layouts.Admin.MasterLayout')

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
            <div class="pt-5">
                <h5 class="">Đánh giá dịch vụ</h5>
                <p>{{ $detailService->rate }}/5
                    <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                    <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                    <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                    <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                    <i class="bi bi-star-half " style="color: rgb(255, 152, 18);"></i>
                </p>
                <div class="row">
                    <div class="row m-auto mb-2  justify-content-center">
                        <div class="col-2">
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                        </div>
                        <div class="col-6">
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" id="star1" data-value="{{ $countRating['count1'] }}">
                                    {{ $countRating['count1'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-auto mb-2  justify-content-center">
                        <div class="col-2">
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                        </div>
                        <div class="col-6">
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" id="star2" data-value="{{ $countRating['count2'] }}">
                                    {{ $countRating['count2'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-auto mb-2  justify-content-center">
                        <div class="col-2">
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                        </div>
                        <div class="col-6">
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" id="star3" data-value="{{ $countRating['count3'] }}">
                                    {{ $countRating['count3'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-auto mb-2  justify-content-center">
                        <div class="col-2">
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                        </div>
                        <div class="col-6">
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" id="star4" data-value="{{ $countRating['count4'] }}">
                                    {{ $countRating['count4'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-auto mb-2  justify-content-center">
                        <div class="col-2">
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                        </div>
                        <div class="col-6">
                            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" id="star5" data-value="{{ $countRating['count5'] }}">
                                    {{ $countRating['count5'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <ul class="list-group list-group-flush mt-4 ">
                        @foreach ($listRating as $row)
                            <li class="list-group-item">
                                <p class="fw-bold">{{ $row->email }}</p>
                                <div class="row">
                                    <p class="col-6">{{ $row->detail_rate }}</p>
                                    <p class="col-4">
                                        @for ($i = 1; $i <= $row->rate; $i++)
                                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                                        @endfor
                                        {{ $row->rate }}
                                    </p>
                                    <div class="col-2">
                                        <button class="btn btn-success mb-2" id="editRate">Chỉnh sửa</button>
                                        <button class="btn btn-success mb-2" id="replyRate">Trả lời</button>
                                        <button class="btn btn-success" id="updateRate">Cập nhật</button>
                                        <button class="btn btn-success" id="sameReply">Mãu</button>
                                    </div>
                                </div>
                                <div class="col-8 h-25">
                                    <textarea name="ratingReply" id="mytext"></textarea>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="row mt-3">
                        <a class="text-center text-decoration-none cursor-pointer" id="showAllButton">Xem tất cả <i
                                class="bi bi-arrow-bar-down"></i></a>
                        <a class="text-center text-decoration-none cursor-pointer" id="hideAllButton">Ẩn bớt <i
                                class="bi bi-arrow-bar-up"></i></a>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('listRating') }}" class="btn btn-secondary me-2">Quay
                        lại</a>
                </div>
            </div>

        </div>
    @endsection
