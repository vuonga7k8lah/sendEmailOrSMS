<?php

namespace SendMail\MassageBird\Controllers;

class MassageBirdController
{
    private string $apiKey='XDHZkoWftIhbfRW8j8bLPa1xK';

    /**
     * @throws \MessageBird\Exceptions\ServerException
     * @throws \MessageBird\Exceptions\RequestException
     * @throws \MessageBird\Exceptions\HttpException
     */
    public function sendSMS()
    {
        $MessageBird = new \MessageBird\Client($this->apiKey);
        $Message = new \MessageBird\Objects\Message();
        $Message->originator = 'TestMessage';
        $Message->recipients = array(84363101188);
        $Message->body = 'This is a test message';

        $MessageBird->messages->create($Message);
    }
}