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

$(document).ready(function () {
    new Chart(document.getElementById("bar-chart-grouped"), {
        type: "bar",
        data: {
            labels: ["1900", "1950", "1999", "2050"],
            datasets: [
                {
                    label: "Africa",
                    backgroundColor: "#3e95cd",
                    data: [133, 221, 783, 2478],
                },
                {
                    label: "Europe",
                    backgroundColor: "#8e5ea2",
                    data: [408, 547, 675, 734],
                },
            ],
        },
        options: {
            title: {
                display: true,
                text: "Population growth (millions)",
            },
        },
    });
});
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

$(document).ready(function() {
    $('#statusSelect').change(function() {
        var selectedStatus = $(this).val();
        $('#statusValue').val(selectedStatus);
    });
});
