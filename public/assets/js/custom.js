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
            $("#sumPrice").text(res.sumPrice);
        },
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
            table.append(
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
                tbody.append(`
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
                pagination.append(
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
            table.append(
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
                tbody.append(`
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
                pagination.append(
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
            table.append(
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
                tbody.append(`
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
                pagination.append(
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
            table.append('<p class="text-center">Chưa có nhân viên nào.</p>');
        } else {
            $.each(data.data, function (index, item) {
                tbody.append(`
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
                pagination.append(
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
            table.append('<p class="text-center">Chưa có khách hàng nào.</p>');
        } else {
            $.each(data.data, function (index, item) {
                tbody.append(`
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
                pagination.append(
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
