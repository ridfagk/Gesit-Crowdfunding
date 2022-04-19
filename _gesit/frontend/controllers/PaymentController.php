<?php
namespace frontend\controllers;


use Yii;
use yii\web\Controller;



class PaymentController extends Controller
{
    public function actionPay()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-OUlRGsIuhdzdZ5FT54YST1T8';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return $this->render('pay', [
            'snapToken' => $snapToken,
        ]);
    }
    
}