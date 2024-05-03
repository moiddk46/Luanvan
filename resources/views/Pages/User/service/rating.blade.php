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
            <h3 class="text-center mt-5 mb-3 fw-bold">Danh giá dịch vụ</h3>
            <form action="{{ route('rating') }}" method="post">
                <table class="table align-middle mb-0 bg-white table-striped">
                    @csrf
                    <thead class="bg-light">
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th>Lời nhận xet</th>
                            <td class="row">
                                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                                <input type="hidden" name="serviceTypeCode" value="{{ $data }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Đánh giá</th>
                            <td>
                                <div class="rating">
                                    <i class="bi bi-star-fill" data-index="1"></i>
                                    <i class="bi bi-star-fill" data-index="2"></i>
                                    <i class="bi bi-star-fill" data-index="3"></i>
                                    <i class="bi bi-star-fill" data-index="4"></i>
                                    <i class="bi bi-star-fill" data-index="5"></i>
                                </div>
                                <input type="hidden" name="starRating" id="starRating">
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('cart') }}" class="btn btn-secondary me-2">Không đánh giá</a>
                    <button type="submit" class="btn btn-success">
                        Đánh giá
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
