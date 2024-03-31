<?php

namespace App\Const;

class KCconst
{
    // Trạng thái

    const DB_STATUS_ORDER_HANDLING = 1; // Đang xử lý
    const DB_STATUS_ORDER_CONFIRMED = 2; // Đã xác nhận
    const DB_STATUS_ORDER_FINISHING = 3; // Đang hoàn thành
    const DB_STATUS_ORDER_FINISHED = 4;  // Đã hoàn thành
}
