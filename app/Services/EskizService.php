<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class EskizService
{
    protected $client;
    protected $email;
    protected $password;
    protected $token;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://notify.eskiz.uz/api/',
        ]);

        $this->email = 'jalilovquvonchbek4@gmail.com';
        $this->password = 'Z89s7c1Hg7QyVSnmqT4fEzrcs7tSuzlp1gkDapz6';

        // Obtain a token upon class initialization
        $this->token = $this->getToken();
    }

    /**
     * Authenticate and get token
     */
    private function getToken()
    {
        try {
            $response = $this->client->post('auth/login', [
                'form_params' => [
                    'email' => $this->email,
                    'password' => $this->password,
                ],
            ]);

            $body = json_decode($response->getBody());
            
            if (isset($body->data->token)) {
                return $body->data->token;
            }

            return "token yo'q";
        } catch (\Exception $e) {
            Log::error("Eskiz Login Error: " . $e->getMessage());
            return "tekonda erorr";
        }
    }

    /**
     * Send SMS
     */
    public function sendSms($phoneNumber, $message)
    {
        try {
            $response = $this->client->post('message/sms/send', [
                'headers' => [
                    'Authorization' => "Bearer {$this->token}",
                ],
                'form_params' => [
                    'mobile_phone' => $phoneNumber,
                    'message' => $message,
                    'from' => '4546', // Sender ID (must be pre-approved by Eskiz)
                ],
            ]);
            return json_decode($response->getBody());
        } catch (\Exception $e) {
            Log::error("Eskiz SMS Sending Error: " . $e->getMessage());
            echo $e->getMessage();
        }
    }
}
