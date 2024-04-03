<?php

namespace App\Const;

class KCconst
{
    // Trạng thái

    const DB_STATUS_ORDER_HANDLING = 1; // Đang xử lý
    const DB_STATUS_ORDER_CONFIRMED = 2; // Đã xác nhận
    const DB_STATUS_ORDER_FINISHING = 3; // Đang hoàn thành
    const DB_STATUS_ORDER_FINISHED = 4;  // Đã hoàn thành
    const DB_STATUS_DONT_REPLY = 5;  // Chưa trả lời
    const DB_STATUS_REPLY = 6;  // Đã trả lời


    //User
    const DB_POSITION_ADMIN = 1; // admin
    const DB_POSITION_STAFF = 2; // staff
    const DB_POSITION_CUSTOMER = 3; // customer

    //số bản
    const DB_QUANTITY_DEFAULT = 1; // admin


}
