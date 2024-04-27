<?php

namespace App\Http\Controllers\pay;

use App\Const\KCconst;
use App\Http\Controllers\Controller;
use App\Http\Requests\priceRequest;
use App\Models\orderModel;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    private $service;
    public function payment(Request $request)
    {
        $formData = $request->all();
        $this->service = new orderModel();
        if ($formData['status'] == KCconst::DB_STATUS_DONT_REPLY) {
            $message = 'Bạn không thể đặt hàng với yêu cầu báo giá chưa được trả lời';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        } else if (empty($formData['quantity'])) {
            $message = 'Bạn đã đặt hàng thất bại.Kiểm tra lại số lượng bản cần.';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $orderId = $this->service->insertOrder($formData);
        if (!isset($orderId) || empty($orderId)) {
            $message = 'Bạn đã đặt hàng không thành công';
            return redirect()->route('cart')->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('statusPayment', ['data' => $orderId]);
        $vnp_TmnCode = "ER4E99U9"; //Mã website tại VNPAY 
        $vnp_HashSecret = "QRZAHUDJXSILAJAOEPTPAWNUSSWROXWN"; //Chuỗi bí mật

        $vnp_TxnRef = $formData['requestId'] . md5(rand(10, 100)); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toan online";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $formData['sum'] * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
    public function statusPayment(Request  $request, $data)
    {
        $formData = $request->all();
        $this->service = new orderModel();
        if (isset($formData['vnp_ResponseCode']) && $formData['vnp_ResponseCode'] == '00') {
            // Giao dịch thành công
            $message = 'Bạn đã đặt hàng và thanh toán thành công';
            return redirect()->route('cart')->with([
                'message' => $message,
                'status' => true
            ]);
        } else {
            $this->service->updateOrderFail($data);
            // Giao dịch không thành công
            $message = 'Bạn đã đặt hàng không thành công. Vui lòng thử lại.';
            return redirect()->route('cart')->with([
                'message' => $message,
                'status' => false
            ]);
        }
    }


    public function paymentLive(Request $request)
    {
        $formData = $request->all();
        $orderId = $formData['orderId'];
        $this->service = new orderModel();

        $count = $this->service->comfirmUser($formData);
        if ($count < 1) {
            $message = 'Xác nhận đơn hàng không thành công. Vui lòng thử lại.';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('statusPayment', ['data' => $orderId]);
        $vnp_TmnCode = "ER4E99U9"; //Mã website tại VNPAY 
        $vnp_HashSecret = "QRZAHUDJXSILAJAOEPTPAWNUSSWROXWN"; //Chuỗi bí mật

        $vnp_TxnRef = $orderId . md5(rand(10, 100)); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toan online";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $formData['sum'] * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
