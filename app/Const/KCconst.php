<?php

namespace App\Const;

class KCconst
{
    // Trạng thái

    const DB_STATUS_ORDER_HANDLING = 1; // Đang xử lý
    const DB_STATUS_ORDER_CONFIRMED = 2; // Đã xác nhận
    const DB_STATUS_ORDER_FINISHING = 3; // Đang hoàn thành
    const DB_STATUS_ORDER_FINISHED = 4;  // Đã hoàn thành

    //reply
    const DB_STATUS_DONT_REPLY = 2;  // Chưa trả lời
    const DB_STATUS_REPLY = 1;  // Đã trả lời


    //User
    const DB_POSITION_ADMIN = 1; // admin
    const DB_POSITION_STAFF = 2; // staff
    const DB_POSITION_CUSTOMER = 3; // customer

    //số bản
    const DB_QUANTITY_DEFAULT = 1; // admin

    //receipt

    const DB_DONT_RECEIPT = 1; // chưa thanh toán
    const DB_DONE_RECEIPT = 2; // đã thanh toán

    // hình thức thanh toán
    const DB_RECEIPT_WHEN_GIVE = 1; // Thanh toán khi nhận hàng
    const DB_RECEIPT_ONLINE = 2; // Thanh toán online


    const DB_FLASH_ON = 1; //FLASH ON
    const DB_FLASH_OFF = 0; // FLASH OFF
}
