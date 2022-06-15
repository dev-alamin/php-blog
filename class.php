<?php

/**
 * Account Holder Class
 * @return mixed
 * 
 */

class CurrencyConverter
{
    const BDT_USD = 88.8;
    const BDT_JPY = 0.7825;
    const BDT_GBP = 115.76;
    const BDT_EUR = 102.53;

    public function convertBDT_to_USD($amount)
    {
        if ($amount > 0) {
            return "$" . $amount / self::BDT_USD;
        } else {
            return 0;
        }
    }
    public function convertBDT_to_GBP($amount)
    {
        if ($amount > 0) {
            return "$" . $amount / self::BDT_GBP;
        } else {
            return 0;
        }
    }
    public function convertBDT_to_EUR($amount)
    {
        if ($amount > 0) {
            return "$" . $amount / self::BDT_EUR;
        } else {
            return 0;
        }
    }
    public function convertBDT_to_JPY($amount)
    {
        if ($amount > 0) {
            return "$" . $amount / self::BDT_JPY;
        } else {
            return 0;
        }
    }
}

$currentcy = new CurrencyConverter();

echo $currentcy->convertBDT_to_USD(100);
echo '<br>';
echo $currentcy->convertBDT_to_JPY(100);
echo '<br>';
echo $currentcy->convertBDT_to_GBP(100);
echo '<br>';
echo $currentcy->convertBDT_to_EUR(100);
