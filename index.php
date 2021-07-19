<?php

use SendMail\Sendinblue\Controllers\SendinblueController;

require_once 'vendor/autoload.php';
try {
    //(new SendinblueController())->sendMail();
    (new \SendMail\MassageBird\Controllers\MassageBirdController())->sendSMS();
} catch (Exception $exception) {
    echo $exception->getMessage();
}
