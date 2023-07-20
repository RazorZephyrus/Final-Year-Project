<?php

namespace App\Services;

class FCMService
{

    protected $api_key;
    protected $base_url;
    protected $client;

    public function __construct()
    {
        $this->api_key = env("FCM_SERVER_KEY");
        $this->base_url = env("FCM_SERVER_URL");
        $this->client = new \GuzzleHttp\Client();
    }


    public function sendPushNotification($token, $notification)
    {

        try {
            $body = [
                "to" => $token,
                "notification" => [
                    "body" => $notification['body'] ?? null,
                    "content_available" => true,
                    "priority" => "high",
                    "subtitle" => $notification['subtitle'] ?? null,
                    "title" => $notification['title'] ?? null,
                    "tag" => $notification['tag'] ?? 'notification'
                ]
            ];

            $ress = $this->client->request('POST', $this->base_url . '/fcm/send', [
                'body' =>  json_encode($body),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' =>  "key=$this->api_key",
                ],
            ]);

            return json_decode($ress->getBody(), true);
        } catch (\Throwable $th) {
            //do nothing
        }
    }
}
