<form action="">
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="form-group col-6">
                    <select class="form-select form-select-lg rounded-pill" name="loaidichvu" id="loaidichvu">
                        <option selected>--Chọn loại dịch vụ--</option>
                        @if (isset($prop))
                            @foreach ($prop as $item)
                                <option value="{{ $item->service_code }}">{{ $item->service_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-6">
                    <select class="form-select form-select-lg rounded-pill" name="dichvu" id="dichvu">
                        <option selected>--Chọn dịch vụ--</option>
                    </select>
                </div>
            </div>
            <div class="form-group mt-2">
                <input class="form-control form-control-lg rounded-pill" type="email" placeholder="test@example.com">
            </div>
        </div>
        <div class="col-4 row">
            <button class="btn btn-dark btn-lg rounded-pill fw-bold fs-4" type="submit">Báo giá</button>
        </div>
    </div>
</form>
