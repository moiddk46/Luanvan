<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanh toán</title>
</head>

<body>
    <form id="frmCreateOrder" action="https://sandbox.vnpayment.vn/button/websrc.html" method="POST" target="_top"> <input
            type="hidden" name="cmd" value="pay"> <input type="hidden" name="hosted_button_id"
            value="kPeirkPPxP"> <input type="hidden" name="hosted_button_token"
            value="6d57a3e6943e29ad961d09761d7e41f0faaa18c4d5673c2363e40b80889a4ce2"> <img
            alt="VNPAY - Thanh toan online" border="0" class="btnRedirect"
            src="https://sandbox.vnpayment.vn/button/Images/paynow-1.png"> </form>
    <script src="https://merchant.vnpay.vn/Scripts/jquery-3.5.1.min.js"></script>
    <link href="https://merchant.vnpay.vn/Scripts/lib/vnpayframe.css" rel="stylesheet" />
    <script src="https://merchant.vnpay.vn/Scripts/lib/vnpayframe.js"></script>
    <script src="https://merchant.vnpay.vn/Scripts/lib/openbutton.js"></script>
</body>

</html>
