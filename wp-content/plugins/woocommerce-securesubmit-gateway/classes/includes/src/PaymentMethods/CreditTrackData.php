<?php

namespace GlobalPayments\Api\PaymentMethods;

$baseDir = dirname(__FILE__);
$originalPath = get_include_path();

ini_set('include_path', $originalPath . PATH_SEPARATOR . $baseDir);

require_once 'Interfaces\ITrackData.php';

use GlobalPayments\Api\PaymentMethods\Interfaces\ITrackData;

class CreditTrackData extends Credit implements ITrackData
{
    public $entryMethod;
    public $value;
}
