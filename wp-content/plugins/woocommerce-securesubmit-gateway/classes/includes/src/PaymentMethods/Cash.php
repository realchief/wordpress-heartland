<?php

namespace GlobalPayments\Api\PaymentMethods;

$baseDir = dirname(__FILE__);
$originalPath = get_include_path();

ini_set('include_path', $originalPath . PATH_SEPARATOR . $baseDir);
require_once 'Interfaces\IPaymentMethod.php';
require_once 'Interfaces\IChargable.php';
require_once 'Interfaces\IRefundable.php';

use GlobalPayments\Api\PaymentMethods\Interfaces\IChargable;
use GlobalPayments\Api\PaymentMethods\Interfaces\IPaymentMethod;
use GlobalPayments\Api\PaymentMethods\Interfaces\IRefundable;

class Cash implements
    IPaymentMethod,
    IChargable,
    IRefundable
{
    public $paymentMethodType = PaymentMethodType::CASH;

    public function charge($amount = null)
    {
        throw new NotImplementedException();
    }

    public function refund($amount = null)
    {
        throw new NotImplementedException();
    }
}
