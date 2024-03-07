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
