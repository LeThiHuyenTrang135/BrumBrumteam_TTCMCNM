<?php

namespace App\Utilities;

class VNPay
{
    public static function vnpay_create_payment(array $data): string
    {
        $vnp_TmnCode    = "J16B037H";
        $vnp_HashSecret = "3X32J32Q8UDQJWFYFI5HHTPNLRA5SXEZ";
        $vnp_Url        = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl  = rtrim(env('APP_URL'), '/') . "/checkout/vnPayCheck";

        $inputData = [
            "vnp_Version"   => "2.1.0",
            "vnp_TmnCode"   => $vnp_TmnCode,
            "vnp_Amount"    => (int)$data['vnp_Amount'], 
            "vnp_Command"   => "pay",
            "vnp_CreateDate"=> date('YmdHis'),
            "vnp_CurrCode"  => "VND",
            "vnp_IpAddr"    => request()->ip(),
            "vnp_Locale"    => "vn",
            "vnp_OrderInfo" => $data['vnp_OrderInfo'],
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef"    => (string)$data['vnp_TxnRef'],
        ];

        ksort($inputData);

        $hashData = "";
        $query = "";
        $i = 0;

        foreach ($inputData as $key => $value) {
            $value = (string)$value;
            $hashData .= ($i ? '&' : '') . $key . "=" . urlencode($value);
            $query    .= urlencode($key) . "=" . urlencode($value) . "&";
            $i++;
        }

        $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        return $vnp_Url . "?" . $query . "vnp_SecureHash=" . $vnpSecureHash;


    }
}
