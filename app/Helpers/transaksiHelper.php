<?php
    namespace App\Helpers;
    
    class transaksiHelper{
        public static function checkStatus($code){
            if ($code == 0) {
                return 'Cancel';
            } elseif ($code == 1) {
                return 'Waiting Payment';
            } elseif ($code == 2) {
               return 'Paid';
            } else {
                return 'Code is not registered';
            }
        }
        public static function checkPayment($code){
            if ($code == 1) {
                return 'Upfront Payment';
            } elseif ($code == 2) {
                return 'Bank Transfer';
            } else {
                return 'Code is not registered';
            }
        }
    }