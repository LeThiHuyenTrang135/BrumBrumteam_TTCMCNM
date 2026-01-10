<?php

namespace App\Utilities;

class Constant
{
    //Cac hang so , role dung chung toan he thong

    // Order
    // const order_status_ReceiveOrders = 1;//dang giao ( 2-1)
    // const order_status_Unconfirmed   = 2; // đang xac nhan
    // const order_status_Confirmed     = 3; // đa giao
    // const order_status_Paid          = 4; // đã thanh toán
    // const order_status_Processing    = 5; // 
    // const order_status_Shipping      = 6; // đã nhận
    // const order_status_Finish        = 7; //hoàn tất
    // const order_status_Cancel        = 0; //đã hủy


        const order_status_Pending    = 0;
    const order_status_Paid       = 1;
    const order_status_Confirming = 2;
    const order_status_Shipped    = 3;
    const order_status_Cancel     = 4;
    const order_status_Completed  = 7;

    // public static $order_status = [
    //     self::order_status_ReceiveOrders => 'Receive Orders',
    //     self::order_status_Unconfirmed   => 'Unconfirmed',
    //     self::order_status_Confirmed     => 'Confirmed',
    //     self::order_status_Paid          => 'Paid',
    //     self::order_status_Processing    => 'Processing',
    //     self::order_status_Shipping      => 'Shipping',
    //     self::order_status_Finish        => 'Finish',
    //     self::order_status_Cancel        => 'Cancel',
    // ];


    
    // User
    const user_level_host  = 0;
    const user_level_admin = 1;
    const user_level_client = 2;

public static $user_level = [
    self::user_level_host  => 'host',
    self::user_level_admin => 'admin',
    self::user_level_client => 'client',

    
];
    const PAYMENT_PAY_LATER = 'pay_later';
    const PAYMENT_ONLINE    = 'online_payment';
    const PAYMENT_STRIPE    = 'stripe';





}