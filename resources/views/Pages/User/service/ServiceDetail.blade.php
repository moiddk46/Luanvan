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
            <h3 class="text-center mt-5 mb-3 fw-bold">Báo giá</h3>
            @if (isset($detailService))
                <div>
                    {!! $detailService->detail_price !!}
                </div>
            @endif
            <div>
                <h5>Đánh giá dịch vụ</h5>
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
                                    <p class="col-8">{{ $row->detail_rate }}</p>
                                    <p class="col-4">
                                        @for ($i = 1; $i <= $row->rate; $i++)
                                            <i class="bi bi-star-fill" style="color: rgb(255, 152, 18);"></i>
                                        @endfor
                                        {{ $row->rate }}
                                    </p>
                                </div>
                                <div class="col-8 mb-2">
                                    @if (isset($row->reply_rating))
                                        <div class="form-order rounded bg-light p-3 replySan">
                                            {!! $row->reply_rating !!}
                                        </div>
                                    @endif
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
            </div>
            @if ($detailService->service_code == 'dichthuat')
                <div class="w-50 form-order rounded bg-light p-3 m-auto mt-5">
                    <h5 class="text-center">Yêu cầu báo giá</h5>
                    <form method="post" action="{{ route('priceRequest') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="serviceTypeCode" value="{{ $detailService->service_type_code }}">
                        <div class="mb-3">
                            <label for="" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        @error('address')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="sdt" class="form-label">Số điện thoại</label>
                            <input type="phone" class="form-control" name="sdt" id="sdt">
                        </div>
                        @error('sdt')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="content" style="height: 100px" name="content" id="content"
                                placeholder="Mẫu: Hãy báo giá dịch thuật tài liệu này giúp tôi,...."></textarea>
                        </div>
                        @error('content')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3 row">
                            <div class="col-8">
                                <label for="formFile" class="form-label">Gửi tài liệu</label>
                                <input class="form-control" type="file" id="formFile" name="files"
                                    placeholder="Chọn file">
                                @error('files')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="page" class="form-label">Số trang trong tài liệu</label>
                                <input class="form-control" type="number" id="page" min="1" value="1"
                                    name="page">
                                @error('page')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-text text-danger mb-3 fw-bold">Nếu Khách hàng sử dụng dịch vụ dịch thuật công
                            chứng
                            với tài liệu bản gốc, vui lòng liên hệ với chúng tôi thông qua zalo hoặc số điện thoại để
                            chúng
                            tôi có thể nhận tài liệu bản gốc. Xin lỗi vì sự bất tiện này. </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <button class="btn btn-success">Yêu cầu báo giá</button>
                        </div>

                    </form>
                </div>
            @else
                <div class="w-50 form-order rounded bg-light p-3 m-auto mt-5">
                    <h5 class="text-center">Đặt hàng</h5>
                    <form method="post" action="{{ route('orderLive') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center mb-3">
                            <div class="form-check col-4">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="home"
                                    value="0" checked>
                                <label class="form-check-label" for="home">
                                    Giao hàng tận nơi
                                </label>
                            </div>
                            <div class="form-check col-4">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="give"
                                    value="1">
                                <label class="form-check-label" for="give">
                                    Đến nhận hàng
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="serviceTypeCode" value="{{ $detailService->service_type_code }}">
                        <input type="hidden" name="serviceTypeName" value="{{ $detailService->service_type_name }}"
                            id="serviceTypeName">
                        @foreach ($statusReceipt as $row)
                            @if ($row->status_id == 1)
                                <input type="hidden" name="statusReceipt" value="{{ $row->status_id }}">
                            @endif
                        @endforeach
                        <input type="hidden" name="currency1" value="{{ $detailService->price }}" id="currency1">
                        <input type="hidden" name="completeTime" value="2" id="completeTime">
                        <input type="hidden" name="idUser" value="{{ Auth::user()->id }}">
                        <div id="infor">
                            <div class="mb-3">
                                <label for="" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" name="address"id="address">
                            </div>
                            @error('address')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="sdt" class="form-label">Số điện thoại</label>
                                <input type="phone" class="form-control" name="sdt" id="sdt">
                            </div>

                            @error('sdt')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="address-company">
                            <div class="mb-3 border border-success rounded bg-body-secondary text-success p-3">
                                <p class="fw-bold">VĂN PHÒNG GIAO DỊCH:</p>
                                <p>125 Điện biên phủ, Phường 15, Quận Bình Thạnh, Thành phố Hồ Chí Minh</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="content" style="height: 100px" name="content"></textarea>
                        </div>
                        @error('content')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label for="formFile" class="form-label">Gửi tài liệu</label>
                                <input class="form-control" type="file" id="formFile" name="files">
                                @error('files')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="quanlity" class="form-label">Số bản</label>
                                <input class="form-control" type="number" id="quantity" min="1" value="1"
                                    name="quantity">
                            </div>
                            <div class="col-4">
                                <label for="page" class="form-label">Số trang trong tài liệu</label>
                                <input class="form-control" type="number" id="page" min="1" value="1"
                                    name="page">
                                @error('page')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-4">Tổng (Tạm tính):</div>
                            <div class="col-8 fw-bold" id="sum2"> </div>
                            <input type="hidden" name="sum" id="sum1" value="">
                        </div>
                        <div class="form-text text-danger mb-3 fw-bold">Chúng tôi phải xác nhận lại số trang trong tài
                            liệu
                            mà
                            khách hàng gửi và báo lại trong chi tiết đơn hàng, để đảm bảo tính minh bạch. Mong quý khách
                            thông cảm vì sự bất tiện này.</div>
                        <div class="mb-3 d-flex justify-content-center">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Đặt hàng
                            </button>
                        </div>



                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h5 class="text-center fw-bold">Thông tin đặt hàng</h5>
                                        <div id="inforComfirm">
                                            <div class="row mt-3 ">
                                                <div class="col-4 py-3 bg-body-secondary">Tên</div>
                                                <div class="col-8 p-3" id="name1"></div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-4 py-3 bg-body-secondary">Đia chỉ</div>
                                                <div class="col-8 p-3" id="address1"></div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-4 py-3 bg-body-secondary">Số điện thoại</div>
                                                <div class="col-8 p-3" id="sdt1"></div>
                                            </div>
                                        </div>
                                        <div id="addressCompanyConfirm" class="row">
                                            <div class="col-4 py-3 bg-body-secondary">Nhận hàng tại</div>
                                            <div class="col-8 text-success p-3">
                                                <p class="fw-bold">VĂN PHÒNG GIAO DỊCH:</p>
                                                <p>125 Điện biên phủ, Phường 15, Quận Bình Thạnh, Thành phố Hồ Chí Minh
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Loại dịch vụ</div>
                                            <div class="col-8 p-3" id="service"></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Số bản</div>
                                            <div class="col-8 p-3" id="quantity1"></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Số trang trong tài liệu</div>
                                            <div class="col-8 p-3" id="page1"></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Thời gian hoàn thành</div>
                                            <div class="col-8 p-3" id="completeTime1"></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-4 py-3 bg-body-secondary">Ghi chú</div>
                                            <div class="col-8 p-3" id="note"></div>
                                        </div>
                                        <div class="row fw-bold ">
                                            <div class="col-4 py-3 bg-body-secondary">Tổng (Tạm tính):</div>
                                            <div class="col-8 p-3" id="sum"> </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer m-auto">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-success" name="redirect"
                                            id="button">Xác
                                            nhận</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            @endif
        </div>

    </div>
@endsection
