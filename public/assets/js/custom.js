$(document).ready(function () {
    $("#dichvu").click(function () {
        var service = $(this).val();
        $.ajax({
            url: `/api/get-service-type?service_code=${service}`,
            type: "GET",
            success: function (res) {
                var data = res;
                var typeservice = "<option selected>--Chọn dịch vụ--</option>";
                data.map((row) => {
                    typeservice += `
                    <option value="${row.service_type_code}">${row.service_type_name}</option>
                    `;
                });
                $("#loaidichvu").html(typeservice);
            },
        });
    });
    var typingTimer;
    var doneTypingInterval = 400; // milliseconds

    $("#lang").keyup(function () {
        clearTimeout(typingTimer);
        if ($(this).val()) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        } else {
            $("#langed").val(""); // Nếu giá trị của lang rỗng, langed sẽ trở về rỗng
        }
    });

    function doneTyping() {
        var lang = $("#lang").val();
        if (lang) {
            // Hiển thị biểu tượng loading
            $(".loading-spinner").show();
            $.ajax({
                url: "/api/translate",
                type: "POST",
                data: {
                    lang: lang,
                },
                success: function (res) {
                    var data = res;
                    $("#langed").val(data); // Đặt dữ liệu trả về vào #langed
                },
                error: function () {
                    $("#langed").val("Error occurred."); // Xử lý lỗi
                },
            });
        } else {
            $("#langed").val(""); // Nếu giá trị của lang rỗng, langed sẽ trở về rỗng
        }
    }
});
$(document).ready(function () {
    $(".toast").toast("show"); // Hiển thị toast
    setTimeout(function () {
        $(".toast").toast("hide"); // Ẩn toast sau 5 giây
    }, 5000);
});

$(document).ready(function () {
    $("#loading").show(); // Hiển thị loading khi trang được load lần đầu tiên

    // Ẩn loading sau 3 giây
    setTimeout(function () {
        $("#loading").hide();
    }, 3000);
});

// $(document).ready(function () {
//     new Chart(document.getElementById("bar-chart-grouped"), {
//         type: "bar",
//         data: {
//             labels: ["1900", "1950", "1999", "2050"],
//             datasets: [
//                 {
//                     label: "Africa",
//                     backgroundColor: "#3e95cd",
//                     data: [133, 221, 783, 2478],
//                 },
//                 {
//                     label: "Europe",
//                     backgroundColor: "#8e5ea2",
//                     data: [408, 547, 675, 734],
//                 },
//             ],
//         },
//         options: {
//             title: {
//                 display: true,
//                 text: "Population growth (millions)",
//             },
//         },
//     });
// });
function formatCurrency(amount) {
    return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(amount);
}
function formatDate(dateString) {
    var date = new Date(dateString);
    var formattedDate = date.toLocaleDateString("vi-VN");
    return formattedDate;
}
$(document).ready(function () {
    // Định dạng số tiền cho tất cả các phần tử có ID "currency"
    $('[id="currency"]').each(function () {
        var currency = $(this).text();
        var formattedCurrency = formatCurrency(currency);
        $(this).text(formattedCurrency);
    });

    // Định dạng ngày cho tất cả các phần tử có ID "date"
    $('[id="date"]').each(function () {
        var dateString = $(this).text();
        var formattedDate = formatDate(dateString);
        $(this).text(formattedDate);
    });
});

$(".checkAll").click(function () {
    $(".check").prop("checked", $(this).prop("checked"));
});

$(document).ready(function () {
    $("#statusSelect").change(function () {
        var selectedStatus = $(this).val();
        $("#statusValue").val(selectedStatus);
    });
});
$(document).ready(function () {
    $("#staff").change(function () {
        var selectedStaff = $(this).val();
        $("#staffValue").val(selectedStaff);
    });
});

$(document).ready(function () {
    $("#sample").click(function () {
        var name = $("#name").text();
        var service = $("#service").text();
        var sampleLetter = `Xin chào ${name}! \nCông ty TranslateGroup xin gửi báo giá ${service} với tệp tài liệu bạn đã gửi là {$money} ạ. `;
        $("#reply").val(sampleLetter);
    });
});

$(document).ready(function () {
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

    var sdt = $("#sdt").val();
    $("#sdt").on("input change", function () {
        sdt = $(this).val();
        updateValues();
    });

    var service = $("#service").text();
    var quantity = $("#quantity").val();
    $("#quantity").on("input change", function () {
        quantity = $(this).val();
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

    function updateValues() {
        var sum = $("#currency1").val() * quantity;

        $("#name1").text(name);
        $("#address1").text(address);
        $("#sdt1").text(sdt);
        $("#quantity1").text(quantity);
        $("#service1").text(service);
        $("#statusReceipt1").text(statusReceipt);
        $("#sum").text(formatCurrency(sum));
        $("#sum1").val(sum);
        $("#completeTime1").text(completeText);
        if (statusValue == 2) {
            $("#form_order").attr(
                "action",
                `http://127.0.0.1:8000/user/auth/payment`
            );
            $("#button").text("Thanh toán");
        } else {
            $("#form_order").attr(
                "action",
                `http://127.0.0.1:8000/user/auth/order`
            );
            $("#button").text("Xác nhận");
        }
    }
    // Gọi hàm updateValues lần đầu để cập nhật giá trị ban đầu
    updateValues();
});

$(document).ready(function () {
    var calendarEl = $("#calendar")[0]; // Lấy phần tử DOM bằng jQuery
    var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: ""
        },
        buttonText: {
            today: 'Hôm nay' // Đặt chữ cho nút 'today'
        },
        locale: "vi",
        initialView: "dayGridMonth",
        events: [
            {
                id: 1,
                title: "8h - 10h",
                start: "2024-04-15T08:00:00",
                end: "2024-04-15T08:00:00",
                color: "#eff5f9",
                textColor: "#1a4862",
                durationEditable: false,
                className: "free",
                additionalInfo: "A great event",
            },
        ],
        selectable: true,
        editable: true,
        select: function(info) {
            // Xử lý khi người dùng chọn một khoảng thời gian trên lịch
            console.log('selected', info);
            // Tạo sự kiện mới khi người dùng chọn một khoảng thời gian
            calendar.addEvent({
                title: 'Sự kiện mới',
                start: info.startStr,
                end: info.endStr,
                allDay: info.allDay
            });
        },
        eventClick: function(info) {
            // Xử lý khi người dùng click vào một sự kiện trên lịch
            console.log('event clicked', info);
        }
    });
    calendar.render();
});

