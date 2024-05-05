$(document).ready(function () {
    $.ajax({
        url: `/api/static`,
        type: "GET",
        success: function (res) {
            $("#taskComplete").text(res.taskComplete);
            $("#countStaff").text(res.countStaff);
            $("#userOrder").text(res.userOrder);
            $("#orderComplete").text(res.orderComplete);
            $("#countCustomer").text(res.countCustomer);
            $("#countOrder").text(res.countOrder);
            $("#receiptComplete").text(res.receiptComplete);
            $("#sumPrice").text(formatCurrency(res.sumPrice));
        },
    });
    $(".editRate, .replyRate").on("click", function () {
        var container = $(this).closest(".list-group-item");
        container.find(".mytext").show(); // Hiển thị textarea
        container.find(".updateRate, .sameReply").show(); // Hiển thị các nút "Cập nhật" và "Mẫu"
        container.find(".editRate, .replyRate").hide(); //
        container.find(".replySan").hide(); // Ẩn các nút "Chỉnh sửa" và "Trả lời"
        if ($(this).hasClass("editRate")) {
            // Nếu là chỉnh sửa, hiển thị nội dung hiện tại trong textarea
            var reply = container.find(".reply_rating").val();
            container.find(".mytext").val(reply);
        }
    });

    var idUser = $("#user_id").val();
    $.ajax({
        url: `/api/countTask?idUser=${idUser}`,
        type: "GET",
        success: function (res) {
            $("#countTask").text(res.countTaskStaff);
            $("#staffComplete").text(res.countTaskDone);
        },
    });

    $(".replyRate").click(function () {
        var container = $(this).closest(".list-group-item");
        container.find(".updateRate, .sameReply, .mytext").show();
        container.find(".editRate, .replyRate").hide();
    });

    $(".sameReply").click(function () {
        var container = $(this).closest(".list-group-item");
        var sampleLetter = `TranslateGroup xin cảm ơn, phản hồi của bạn, chúng tôi sẽ khắc phục những thiếu xót và nâng cao chất lượng dịch vụ để quý khách có sự hài lòng hơn với chúng tôi.
        Xin trân thành cảm ơn!`;
        container.find(".mytext").val(sampleLetter);
    });
    function tinhToan(data) {
        var val = data / 100;
        var name = `${val * 1000}% `;
        return name;
    }
    var valueStar1 = $("#star1").data("value");

    var valClass1 = tinhToan(valueStar1);
    $("#star1").css("width", valClass1);
    var valueStar2 = $("#star2").data("value");
    var valClass2 = tinhToan(valueStar2);
    $("#star2").css("width", valClass2);
    var valueStar3 = $("#star3").data("value");
    var valClass3 = tinhToan(valueStar3);
    $("#star3").css("width", valClass3);
    var valueStar4 = $("#star4").data("value");
    var valClass4 = tinhToan(valueStar4);
    $("#star4").css("width", valClass4);
    var valueStar5 = $("#star5").data("value");
    var valClass5 = tinhToan(valueStar5);
    $("#star5").css("width", valClass5);

    var itemsCount = $(".list-group-item").length;
    if (itemsCount > 5) {
        $("#showAllButton").show();
        $("#hideAllButton").hide(); // Hiển thị nút nếu có nhiều hơn 4 mục
    }
    $("#showAllButton").click(function () {
        $("#hideAllButton").show();
        $(".list-group-item:nth-child(n+5").show(); // Hiển thị tất cả các mục
        $(this).hide(); // Ẩn nút sau khi được nhấn
    });
    $("#hideAllButton").click(function () {
        $("#showAllButton").show();
        $(".list-group-item:nth-child(n+5)").hide(); // Hiển thị tất cả các mục
        $(this).hide(); // Ẩn nút sau khi được nhấn
    });

    $(".rating .bi").click(function () {
        var index = $(this).data("index");
        updateRating(index);
        $("#starRating").val(index); // Cập nhật giá trị cho input ẩn
    });

    function updateRating(index) {
        $(".rating .bi").each(function () {
            var currentIndex = $(this).data("index");
            if (currentIndex <= index) {
                $(this).addClass("selected");
            } else {
                $(this).removeClass("selected");
            }
        });
    }

    $("#detail").on("keyup", function () {
        var textareaVal = $(this);
        textareaVal.val(sanitizeInput(textareaVal.val()));
    });

    function sanitizeInput(input) {
        var profanity = ["má", "mẹ", "lồn", "cặc", "cứt"];
        var regex = new RegExp(profanity.join("|"), "gi");
        return input.replace(regex, function (matched) {
            return "*".repeat(matched.length);
        });
    }
    $("#resultSearch").hide();
    $("#search").on("keyup", function () {
        $("#resultSearch").show();
        var value = $(this).val().toLowerCase();
        if (value === "") {
            // Nếu giá trị tìm kiếm là rỗng, xóa kết quả hiện có
            $("#resultSearch").html("");
            return; // Không gọi AJAX nếu không có giá trị tìm kiếm
        }
        $.ajax({
            url: `/api/searchService?key=${value}`,
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                var resultSearch = "";
                res.forEach((row) => {
                    resultSearch += `<a href="http://127.0.0.1:8000/user/service/detail/${row.service_type_code}" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1">${row.service_type_name}</p>
                </div>
            </a>`;
                });
                $("#resultSearch").html(resultSearch);
            },
        });
    });

    $("#searchOrder").on("input", function () {
        var value = $(this).val().toLowerCase();
        $.ajax({
            url: `/api/searchOrder?key=${value}`,
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                var data = res.data;
                var status = {};

                // Chuyển đổi dữ liệu status từ object thành mảng
                Object.values(res.status).forEach((item) => {
                    status[item.status_id] = item.status;
                });
                var resultSearch = "";
                if (data) {
                    data.forEach((item) => {
                        resultSearch += `
                            <tr>
                                <td>
                                    <input class="border border-dark check" type="checkbox" name="orderIds[]"
                                        ${
                                            item.status_id == "4"
                                                ? "disabled"
                                                : ""
                                        } value="${item.order_id}|${
                            item.id_user
                        }">
                                </td>
                                <td>${item.order_id}</td>
                                <td>${item.service_type_name}</td>
                                <td>${item.order_date}</td>
                                <td>
                                    <span class="badge  
                                        ${
                                            item.status_id == "1"
                                                ? "text-bg-warning"
                                                : ""
                                        }
                                        ${
                                            item.status_id == "2"
                                                ? "text-bg-primary"
                                                : ""
                                        }
                                        ${
                                            item.status_id == "3"
                                                ? "text-bg-secondary"
                                                : ""
                                        }
                                        ${
                                            item.status_id != "1" &&
                                            item.status_id != "2" &&
                                            item.status_id != "3"
                                                ? "text-bg-success"
                                                : ""
                                        }
                                        rounded-pill d-inline">${
                                            status[item.status_id]
                                        }</span>
                                </td>
                                <td>
                                    <a href="http://127.0.0.1:8000/admin/order/detailOrder/${
                                        item.order_id
                                    }" class="btn btn-outline-dark">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>`;
                    });
                }
                $("#orderTable tbody").html(resultSearch);
            },
        });
    });

    $("#searchPriceRequest").on("input", function () {
        var value = $(this).val().toLowerCase();
        $.ajax({
            url: `/api/searchPriceRequest?key=${value}`,
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                var resultSearch = "";
                if (res) {
                    res.forEach((item) => {
                        resultSearch += `
                            <tr>
                                <td>${item.request_id}</td>
                                <td>${item.service_type_name}</td>
                                <td id="date">${item.request_date}</td>
                                <td>
                                    <span class="badge  
                                        ${
                                            item.status_id == "2"
                                                ? "text-bg-warning"
                                                : "text-bg-success"
                                        }
                                        rounded-pill d-inline">${
                                            item.status
                                        }</span>
                                </td>
                                <td>
                                    <a href="http://127.0.0.1:8000/admin/priceRequest/detailPriceRequest/${
                                        item.request_id
                                    }" class="btn btn-outline-dark">
                                        Trả lời
                                    </a>
                                    <a href="http://127.0.0.1:8000/admin/priceRequest/deletePriceRequest/${
                                        item.request_id
                                    }" class="btn btn-outline-danger modalTrigger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-action="delete" data-request-id="${
                            item.request_id
                        }">
                                        Xóa
                                    </a>
                                </td>
                            </tr>`;
                    });
                }
                $("#priceRequestTable tbody").html(resultSearch);
                $(".modalTrigger").on("click", function (event) {
                    event.preventDefault(); // Ngăn không cho thẻ a thực hiện hành động mặc định

                    var action = $(this).data("action"); // Lấy hành động (trả lời hoặc xóa)
                    var href = $(this).attr("href");
                    // Lấy href (URL)

                    if (action === "delete") {
                        $("#exampleModalLabel").text("Xác Nhận Xóa");
                        $(".modal-body").text("Bạn có chắc chắn muốn xóa?");
                    }

                    // Cập nhật nút hành động trong modal
                    $("#modalActionBtn")
                        .off("click")
                        .on("click", function () {
                            window.location.href = href; // Chuyển hướng theo URL của nút
                        });
                });
            },
        });
    });

    $("#searchTask").on("input", function () {
        var value = $(this).val().toLowerCase();
        var idUser = $("#user_id").val();
        $.ajax({
            url: `/api/searchTask?key=${value}&idUser=${idUser}`,
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                console.log(res);
                var resultSearch = "";
                if (res) {
                    res.forEach((item) => {
                        var statusClass;
                        switch (item.status_id) {
                            case 1:
                                statusClass = "text-bg-warning";
                                break;
                            case 2:
                                statusClass = "text-bg-primary";
                                break;
                            case 3:
                                statusClass = "text-bg-secondary";
                                break;
                            default:
                                statusClass = "text-bg-success";
                                break;
                        }
                        resultSearch += `<tr>
                        <td>${item.order_id}</td>
                        <td>${item.service_type_name}</td>
                        <td>${item.complete_time}</td>
                        <td>${item.order_date}</td>
                        <td>
                    <span class="badge ${statusClass} rounded-pill d-inline">${item.status}</span>
                </td>
                        <td><a href="http://127.0.0.1:8000/staff/detailTask/${item.order_id}" class="btn btn-outline-dark">Chi tiết</a></td>
                    </tr>`;
                    });
                }
                $("#table-task tbody").html(resultSearch);
            },
        });
    });

    var year = $("#year").val();
    var myChart = null; // Biến toàn cục để lưu biểu đồ

    $("#year").change(function () {
        year = $(this).val();
        updateYear();
    });

    function updateYear() {
        $.ajax({
            url: `/api/getSumYear?year=${year}`,
            type: "GET",
            success: function (res) {
                var data = new Array(12).fill(0);
                res.map((row) => {
                    var monthIndex = parseInt(row.month) - 1;
                    data[monthIndex] = row.total_sum_price;
                });

                var ctx = document.getElementById("myChart");
                if (ctx) {
                    if (myChart) {
                        myChart.destroy(); // Hủy biểu đồ cũ trước khi tạo mới
                    }
                    var canvas = ctx.getContext("2d");
                    myChart = new Chart(canvas, {
                        type: "line",
                        data: {
                            labels: [
                                "Tháng 1",
                                "Tháng 2",
                                "Tháng 3",
                                "Tháng 4",
                                "Tháng 5",
                                "Tháng 6",
                                "Tháng 7",
                                "Tháng 8",
                                "Tháng 9",
                                "Tháng 10",
                                "Tháng 11",
                                "Tháng 12",
                            ],
                            datasets: [
                                {
                                    label: "Doanh thu theo tháng",
                                    data: data,
                                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                                    borderColor: "rgba(75, 192, 192, 1)",
                                    borderWidth: 1,
                                },
                            ],
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                },
                            },
                        },
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching data: " + error);
            },
        });
    }
    $("#exportDataBtn").click(function () {
        var BOM = "\uFEFF"; // BOM cho UTF-8
        var csvContent = "data:text/csv;charset=utf-8," + BOM;

        var data = myChart.data.datasets[0].data;
        var labels = myChart.data.labels;

        // Thêm labels (tháng) vào dòng đầu tiên
        var labelRow = labels.join(",") + "\n";
        csvContent += labelRow;

        // Thêm giá trị doanh thu vào dòng thứ hai
        var dataRow = data.join(",") + "\n";
        csvContent += dataRow;

        // Tạo liên kết để tải xuống CSV
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "doanhthu.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    updateYear(); // Khởi tạo biểu đồ khi tải trang
    $("#serviceTypeCode").change(function () {
        var serviceTypeCode = $(this).val(); // Lấy giá trị được chọn

        // Gửi yêu cầu AJAX
        $.ajax({
            url: `/api/getPrice?serviceTypeCode=${serviceTypeCode}`, // Thay thế 'your-url-here' bằng URL bạn cần gửi yêu cầu
            type: "GET",
            success: function (response) {
                response.map((row) => {
                    var price = row.price;
                    $("#currency1").val(price);
                    updateValues();
                });
            },
            error: function (xhr, status, error) {
                // Xử lý khi có lỗi xảy ra
                console.error("Error:", error);
            },
        });
    });

    $(".toast").toast("show"); // Hiển thị toast
    setTimeout(function () {
        $(".toast").toast("hide"); // Ẩn toast sau 5 giây
    }, 5000);

    function formatCurrency(amount) {
        return new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
        }).format(amount);
    }
    // Định dạng số tiền cho tất cả các phần tử có ID "currency"
    $('[id="currency"]').each(function () {
        var currency = $(this).text();
        var formattedCurrency = formatCurrency(currency);
        $(this).text(formattedCurrency);
    });

    $(".checkAll").click(function () {
        $(".check").prop("checked", $(this).prop("checked"));
    });

    $("#statusSelect").change(function () {
        var selectedStatus = $(this).val();
        $("#statusValue").val(selectedStatus);
    });
    $("#statusReceipt").change(function () {
        var selectedStatus = $(this).val();
        $("#statusReceiptValue").val(selectedStatus);
    });
    $("#staff").change(function () {
        var selectedStaff = $(this).val();
        $("#staffValue").val(selectedStaff);
    });

    $("#currency1").change(function () {
        $("#currency1").val();
        updateValues();
    });
    $("#sample").click(function () {
        var name = $("#name").text();
        var service = $("#service").text();
        var money = formatCurrency($("#price").val());
        var sampleLetter = `Xin chào ${name}! \nCông ty TranslateGroup xin gửi báo giá ${service} với tệp tài liệu bạn đã gửi là ${money} ạ. `;
        tinymce.get("mytext").setContent(sampleLetter);
    });

    var name = $("#name").val();
    $("#name").on("input change", function () {
        name = $(this).val();
        updateValues();
    });

    var address = $("#address").val();
    $("#address").on("input change", function () {
        address = $(this).val();
        updateValues();
    });

    var note = $("#content").val();
    $("#content").on("input change", function () {
        note = $(this).val();
        updateValues();
    });

    var sdt = $("#sdt").val();
    $("#sdt").on("input change", function () {
        sdt = $(this).val();
        updateValues();
    });

    var serviceTypeName = $("#serviceTypeName").val();
    $("#serviceTypeName").on("input change", function () {
        serviceTypeName = $(this).val();
        updateValues();
    });

    var service = $("#service").text();
    var quantity = $("#quantity").val();
    $("#quantity").on("input change", function () {
        quantity = $(this).val();
        updateValues();
    });

    var page = $("#page").val();
    $("#page").on("input change", function () {
        page = $(this).val();
        updateValues();
    });
    var statusValue = $("#statusReceipt").val();

    var completeTime = parseInt($("#completeTime").val());

    // Lấy ngày hiện tại
    var currentDate = new Date();

    // Lấy ngày hiện tại đã cộng thêm 5 ngày
    var futureDate = new Date();

    // Định dạng ngày tháng năm cho ngày hiện tại
    var dayOfWeek = currentDate.getDay();
    if (dayOfWeek == 0) {
        var otherDay = currentDate.getDate() + 1;
    } else {
        var otherDay = currentDate.getDate();
    }
    futureDate.setDate(otherDay + completeTime);
    var currentDay = currentDate.getDate();
    var currentMonth = currentDate.getMonth() + 1; // Lưu ý: Tháng bắt đầu từ 0, nên cần cộng thêm 1
    var currentYear = currentDate.getFullYear();

    var futureDay = futureDate.getDate();
    var futureMonth = futureDate.getMonth() + 1;
    var futureYear = futureDate.getFullYear();

    // Chuỗi biểu diễn ngày tháng năm cho ngày hiện tại
    var formattedCurrentDate =
        currentDay + "/" + currentMonth + "/" + currentYear;

    // Chuỗi biểu diễn ngày tháng năm cho ngày hiện tại đã cộng thêm 5 ngày
    var formattedFutureDate = futureDay + "/" + futureMonth + "/" + futureYear;

    var completeText = formattedCurrentDate + "-" + formattedFutureDate;
    var statusReceipt = $("#statusReceipt option:selected").text();
    $("#statusReceipt").change(function () {
        statusReceipt = $(this).find("option:selected").text();
        statusValue = $(this).val();
        updateValues();
    });
    var serviceTypeCode = $("#serviceTypeCode option:selected").text();
    $("#serviceTypeCode").change(function () {
        serviceTypeCode = $(this).find("option:selected").text();
        updateValues();
    });

    var give = $('input[type="radio"][name="deliveryOption"]').val();
    $('input[type="radio"][name="deliveryOption"]').change(function () {
        give = $(this).val();
        if (give == 1) {
            $("#inforComfirm").hide();
            $("#addressCompanyConfirm").show();
        }
    });
    if (give == 0) {
        $("#inforComfirm").show();
        $("#addressCompanyConfirm").hide();
    } else {
        $("#inforComfirm").hide();
        $("#addressCompanyConfirm").show();
    }
    $("#message").hide();
    function updateValues() {
        var sum = page * $("#currency1").val() * quantity;
        if (sum < 10000 && statusValue == "2") {
            $("#orderButton").attr("disabled", "disabled");
            $("#message").show(); // Đúng cách vô hiệu hóa nút
        } else {
            $("#message").hide();
            $("#orderButton").removeAttr("disabled"); // Kích hoạt lại nút nếu sum >= 10000
        }

        $("#name1").text(name);
        $("#address1").text(address);
        $("#sdt1").text(sdt);
        $("#quantity1").text(quantity + " Bản");
        $("#page1").text(page + " Trang");
        $("#service1").text(service);
        $("#service2").text(serviceTypeCode);
        $("#service").text(serviceTypeName);
        $("#statusReceipt1").text(statusReceipt);
        $("#sum").text(formatCurrency(sum));
        $("#sum2").text(formatCurrency(sum));
        $("#sum1").val(sum);
        $("#note").text(note);
        $("#completeTime1").text(completeText);
        if (statusValue == 2) {
            $("#form_order").attr(
                "action",
                `http://127.0.0.1:8000/user/auth/payment`
            );
            $("#form_order1").attr(
                "action",
                `http://127.0.0.1:8000/user/auth/paymentLive`
            );
            $("#form_order3").attr(
                "action",
                `http://127.0.0.1:8000/admin/order/paymentAdmin`
            );
            $("#button").text("Thanh toán");
        } else {
            $("#form_order").attr(
                "action",
                `http://127.0.0.1:8000/user/auth/order`
            );
            $("#form_order1").attr(
                "action",
                `http://127.0.0.1:8000/user/auth/comfirmUser`
            );
            $("#form_order3").attr(
                "action",
                `http://127.0.0.1:8000/admin/order/addOrderAdmin`
            );
            $("#button").text("Xác nhận");
        }
    }
    // Gọi hàm updateValues lần đầu để cập nhật giá trị ban đầu
    updateValues();
});

$(document).ready(function () {
    $("#done").change(function () {
        $.ajax({
            url: `/staff/doneTask`,
            type: "GET",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    });

    function updateTable(data) {
        var tbody = $("#ordersTableBody");
        var table = $("#table-task");
        tbody.empty(); // Xóa dữ liệu hiện tại
        if (data.data.length === 0) {
            table.empty();
            table.html(
                '<p class="text-center" id="messageTask">Chưa có nhiệm vụ đã hoàn thành nào.</p>'
            );
        } else {
            if ($("#messageTask").text) {
                $(this).hide;
            }
            $.each(data.data, function (index, item) {
                var statusClass;
                switch (item.status_id) {
                    case 1:
                        statusClass = "text-bg-warning";
                        break;
                    case 2:
                        statusClass = "text-bg-primary";
                        break;
                    case 3:
                        statusClass = "text-bg-secondary";
                        break;
                    default:
                        statusClass = "text-bg-success";
                        break;
                }
                tbody.html(`
                    <tr>
                        <td>${item.order_id}</td>
                        <td>${item.service_type_name}</td>
                        <td>${item.complete_time}</td>
                        <td>${item.order_date}</td>
                        <td>
                    <span class="badge ${statusClass} rounded-pill d-inline">${item.status}</span>
                </td>
                        <td><a href="http://127.0.0.1:8000/staff/detailTask/${item.order_id}" class="btn btn-outline-dark">Chi tiết</a></td>
                    </tr>
                `);
            });
        }
    }

    function updatePagination(data) {
        var pagination = $(".pagination");
        pagination.empty(); // Xóa phân trang hiện tại

        if (data.total > 0) {
            // Tạo các nút cho mỗi trang
            for (let page = 1; page <= data.last_page; page++) {
                pagination.html(
                    `<li class="page-item ${
                        page === data.current_page ? "active" : ""
                    }"><a href="#" class="page-link" onclick="fetchPage('${
                        data.path
                    }?page=${page}')">${page}</a></li>`
                );
            }
        }
    }

    window.fetchPage = function (url) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    };
});

$(document).ready(function () {
    $("#donot").change(function () {
        $.ajax({
            url: `/staff/doNotTask`,
            type: "GET",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    });

    function updateTable(data) {
        var tbody = $("#ordersTableBody");
        var table = $("#table-task");
        tbody.empty(); // Xóa dữ liệu hiện tại
        if (data.data.length === 0) {
            table.empty();
            table.html(
                '<p class="text-center" id="messageTask">Chưa có nhiệm vụ chưa hoàn thành nào.</p>'
            );
        } else {
            if ($("#messageTask").text) {
                $(this).hide;
            }
            $.each(data.data, function (index, item) {
                var statusClass;
                switch (item.status_id) {
                    case 1:
                        statusClass = "text-bg-warning";
                        break;
                    case 2:
                        statusClass = "text-bg-primary";
                        break;
                    case 3:
                        statusClass = "text-bg-secondary";
                        break;
                    default:
                        statusClass = "text-bg-success";
                        break;
                }
                tbody.html(`
                    <tr>
                        <td>${item.order_id}</td>
                        <td>${item.service_type_name}</td>
                        <td>${item.complete_time}</td>
                        <td>${item.order_date}</td>
                        <td>
                    <span class="badge ${statusClass} rounded-pill d-inline">${item.status}</span>
                </td>
                        <td><a href="http://127.0.0.1:8000/staff/detailTask/${item.order_id}" class="btn btn-outline-dark">Chi tiết</a></td>
                    </tr>
                `);
            });
        }
    }

    function updatePagination(data) {
        var pagination = $(".pagination");
        pagination.empty(); // Xóa phân trang hiện tại

        if (data.total > 0) {
            // Tạo các nút cho mỗi trang
            for (let page = 1; page <= data.last_page; page++) {
                pagination.html(
                    `<li class="page-item ${
                        page === data.current_page ? "active" : ""
                    }"><a href="#" class="page-link" onclick="fetchPage('${
                        data.path
                    }?page=${page}')">${page}</a></li>`
                );
            }
        }
    }

    window.fetchPage = function (url) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    };
});

$(document).ready(function () {
    $("#allTask").change(function () {
        $.ajax({
            url: `/staff/allTask`,
            type: "GET",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    });

    function updateTable(data) {
        var tbody = $("#ordersTableBody");
        var table = $("#table-task");
        tbody.empty(); // Xóa dữ liệu hiện tại
        if (data.data.length === 0) {
            table.empty();
            table.html(
                '<p class="text-center" id="messageTask">Chưa có nhiệm vụ nào.</p>'
            );
        } else {
            if ($("#messageTask").text) {
                $(this).hide;
            }
            $.each(data.data, function (index, item) {
                var statusClass;
                switch (item.status_id) {
                    case 1:
                        statusClass = "text-bg-warning";
                        break;
                    case 2:
                        statusClass = "text-bg-primary";
                        break;
                    case 3:
                        statusClass = "text-bg-secondary";
                        break;
                    default:
                        statusClass = "text-bg-success";
                        break;
                }
                tbody.html(`
                    <tr>
                        <td>${item.order_id}</td>
                        <td>${item.service_type_name}</td>
                        <td>${item.complete_time}</td>
                        <td>${item.order_date}</td>
                        <td>
                    <span class="badge ${statusClass} rounded-pill d-inline">${item.status}</span>
                </td>
                        <td><a href="http://127.0.0.1:8000/staff/detailTask/${item.order_id}" class="btn btn-outline-dark">Chi tiết</a></td>
                    </tr>
                `);
            });
        }
    }

    function updatePagination(data) {
        var pagination = $(".pagination");
        pagination.empty(); // Xóa phân trang hiện tại

        if (data.total > 0) {
            // Tạo các nút cho mỗi trang
            for (let page = 1; page <= data.last_page; page++) {
                pagination.html(
                    `<li class="page-item ${
                        page === data.current_page ? "active" : ""
                    }"><a href="#" class="page-link" onclick="fetchPage('${
                        data.path
                    }?page=${page}')">${page}</a></li>`
                );
            }
        }
    }

    window.fetchPage = function (url) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    };
});

$(document).ready(function () {
    $("#formFile").on("change", function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#displayImage").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});

$(document).ready(function () {
    // Kiểm tra nếu select có ID 'position' bị disabled
    if ($("#position").is(":disabled")) {
        $("#message_disable").text(
            "Chức năng cập nhật quyền hạn bị vô hiệu hóa, do bạn đang đăng nhập bằng tài khoản này"
        );
    }
});

$(document).ready(function () {
    $("#staff").change(function () {
        $.ajax({
            url: `getStaff`,
            type: "GET",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    });

    function updateTable(data) {
        var tbody = $("#ordersTableBody");
        var table = $("#table-user");
        tbody.empty(); // Xóa dữ liệu hiện tại
        if (data.data.length === 0) {
            table.empty();
            table.html('<p class="text-center">Chưa có nhân viên nào.</p>');
        } else {
            $.each(data.data, function (index, item) {
                tbody.hmtl(`
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td id="date">${item.created_at}</td>
                        <td>
                        <a href="http://127.0.0.1:8000/admin/user/detailUser/${item.id}" class="btn btn-outline-dark">Chi tiết</a>
                        <a href="http://127.0.0.1:8000/admin/user/deleteUser/${item.id}" class="btn btn-outline-danger modalTrigger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-action="delete">
                                        Xóa
                                    </a>
                                    </td>
                    </tr>
                `);
                $(".modalTrigger").on("click", function (event) {
                    event.preventDefault(); // Ngăn không cho thẻ a thực hiện hành động mặc định

                    var action = $(this).data("action"); // Lấy hành động (trả lời hoặc xóa)
                    var href = $(this).attr("href");
                    // Lấy href (URL)

                    if (action === "delete") {
                        $("#exampleModalLabel").text("Xác Nhận Xóa");
                        $(".modal-body").text("Bạn có chắc chắn muốn xóa?");
                    }

                    // Cập nhật nút hành động trong modal
                    $("#modalActionBtn")
                        .off("click")
                        .on("click", function () {
                            window.location.href = href; // Chuyển hướng theo URL của nút
                        });
                });
            });
        }
    }

    function updatePagination(data) {
        var pagination = $(".pagination");
        pagination.empty(); // Xóa phân trang hiện tại

        if (data.total > 0) {
            // Tạo các nút cho mỗi trang
            for (let page = 1; page <= data.last_page; page++) {
                pagination.html(
                    `<li class="page-item ${
                        page === data.current_page ? "active" : ""
                    }"><a href="#" class="page-link" onclick="fetchPage('${
                        data.path
                    }?page=${page}')">${page}</a></li>`
                );
            }
        }
    }

    window.fetchPage = function (url) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    };
});

$(document).ready(function () {
    $("#customer").change(function () {
        $.ajax({
            url: `getCustomer`,
            type: "GET",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    });

    function updateTable(data) {
        var tbody = $("#ordersTableBody");
        var table = $("#table-user");
        tbody.empty(); // Xóa dữ liệu hiện tại
        if (data.data.length === 0) {
            table.empty();
            table.html('<p class="text-center">Chưa có khách hàng nào.</p>');
        } else {
            $.each(data.data, function (index, item) {
                tbody.html(`
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td id="date">${item.created_at}</td>
                        <td><a href="http://127.0.0.1:8000/admin/user/detailUser/${item.id}" class="btn btn-outline-dark">Chi tiết</a>
                        <a href="http://127.0.0.1:8000/admin/user/deleteUser/${item.id}" class="btn btn-outline-danger modalTrigger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-action="delete">
                                        Xóa
                                    </a>
                                    </td>
                    </tr>
                `);
                $(".modalTrigger").on("click", function (event) {
                    event.preventDefault(); // Ngăn không cho thẻ a thực hiện hành động mặc định

                    var action = $(this).data("action"); // Lấy hành động (trả lời hoặc xóa)
                    var href = $(this).attr("href");
                    // Lấy href (URL)

                    if (action === "delete") {
                        $("#exampleModalLabel").text("Xác Nhận Xóa");
                        $(".modal-body").text("Bạn có chắc chắn muốn xóa?");
                    }

                    // Cập nhật nút hành động trong modal
                    $("#modalActionBtn")
                        .off("click")
                        .on("click", function () {
                            window.location.href = href; // Chuyển hướng theo URL của nút
                        });
                });
            });
        }
    }

    function updatePagination(data) {
        var pagination = $(".pagination");
        pagination.empty(); // Xóa phân trang hiện tại

        if (data.total > 0) {
            // Tạo các nút cho mỗi trang
            for (let page = 1; page <= data.last_page; page++) {
                pagination.html(
                    `<li class="page-item ${
                        page === data.current_page ? "active" : ""
                    }"><a href="#" class="page-link" onclick="fetchPage('${
                        data.path
                    }?page=${page}')">${page}</a></li>`
                );
            }
        }
    }

    window.fetchPage = function (url) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                updateTable(data);
                updatePagination(data);
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    };
});

$(document).ready(function () {
    if ($("#home").is(":checked")) {
        $("#address-company").hide();
    }
    // Khi giá trị của radio button thay đổi
    $('input[type="radio"][name="deliveryOption"]').change(function () {
        if (this.id == "home") {
            $("#infor").show();
            $("#address-company").hide();
            $("#inforRequest").css("display", "");
            $("#inforRequest1").css("display", "");
            $("#inforRequest2").css("display", "");
            $("#companyRequest").css("display", "none");
            // Thực hiện các hành động khi lựa chọn giao hàng tận nơi
        } else if (this.id == "give") {
            $("#infor").hide();
            $("#address-company").show();
            $("#inforRequest").css("display", "none");
            $("#inforRequest1").css("display", "none");
            $("#inforRequest2").css("display", "none");
            $("#companyRequest").css("display", "");
            // Thực hiện các hành động khi lựa chọn đến nhận hàng
        }
    });
});
$(document).ready(function () {
    $(".modalTrigger").on("click", function (event) {
        console.log("1");
        event.preventDefault(); // Ngăn không cho thẻ a thực hiện hành động mặc định

        var action = $(this).data("action"); // Lấy hành động (trả lời hoặc xóa)
        var href = $(this).attr("href");
        // Lấy href (URL)

        if (action === "delete") {
            $("#exampleModalLabel").text("Xác Nhận Xóa");
            $(".modal-body").text("Bạn có chắc chắn muốn xóa?");
        }

        // Cập nhật nút hành động trong modal
        $("#modalActionBtn")
            .off("click")
            .on("click", function () {
                console.log("1");
                window.location.href = href; // Chuyển hướng theo URL của nút
            });
    });
});
