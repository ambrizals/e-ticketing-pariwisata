<?php
    namespace App\Helpers;
    use Facades\Yugo\SMSGateway\Interfaces\SMS;
    use Twilio;
    
    class smsHelper{
        public static function sendSMS($destination, $msg){
            $sms = SMS::send([$destination], $msg);
            if ($sms['code'] == 400){
                Twilio::message('+62'.$destination, $msg);
            }
        }
    }