<?php

namespace SendMail\Sendinblue\Controllers;

use Exception;
use GuzzleHttp\Client;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;

class SendinblueController
{
    protected array $aData     = [];
    private string  $mailAPI   = 'https://api.sendinblue.com/v3/smtp/email';
    private string  $apiKey    = '';
    private array   $aReceiver = [];

    public function __construct()
    {
        $this->apiKey = "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";
    }

    public function setReceiver(): SendinblueController
    {
        return $this;
    }

    /**
     * @throws Exception
     */
    public function sendMail(): bool
    {
//        $oInfo = $this->getInfoAccount();
//        $headers = $this->getHeadersCurl();
//        $aData = [
//            'sender' => [
//                'name'  => $oInfo->getCompanyName(),
//                'email' => $oInfo->getEmail()
//            ],
//            'type'   => 'classic'
//        ];
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->apiKey);

        $apiInstance = new TransactionalEmailsApi(
            new Client(),
            $config
        );
        $sendSmtpEmail
            = new SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
        $sendSmtpEmail['to'] = [['email' => 'vuonga7k8lah@gmail.com', 'name' => 'John Doe']];
        $sendSmtpEmail['templateId'] = 3;
        $sendSmtpEmail['params'] = ['name' => 'John', 'surname' => 'Doe'];
        $sendSmtpEmail['headers']
            = ['accept'       => 'application/json',
               'api-key'      => $this->apiKey,
               'content-type' => 'application/json'];

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }

    }

    /**
     * @throws Exception
     */
    public function getInfoAccount()
    {
        try {
            //get Account info
            $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $this->apiKey);
            $apiInstance = new AccountApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
                new Client(),
                $config
            );
            return $apiInstance->getAccount();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }

    public function getHeadersCurl(): array
    {
        return [
            'accept'       => 'application/json',
            'api-key'      => $this->apiKey,
            'content-type' => 'application/json',
        ];
    }
}