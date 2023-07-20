<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Firebase\JWT\JWT;

class FirebaseNotificationService
{
    protected $private_key;
    protected $token_uri;
    protected $client_email;
    protected $base_url;
    protected $project_id;
    protected $guzzle;

    public function __construct()
    {
        $this->private_key =  env("FCM_PRIVATE_KEY");
        $this->token_uri = env("FCM_TOKEN_URI");
        $this->client_email = env("FCM_CLIENT_EMAIL");
        $this->project_id = env("FCM_PROJECT_ID");
        $this->base_url = env("FCM_FCM_V1_URL");
        $this->guzzle = new \GuzzleHttp\Client();
    }

    public function getOauthToken()
    {
        try {
            $now_seconds = time();

            $privateKey = $this->private_key;

            $payload = [
                'iss' => $this->client_email,
                'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
                'aud' => $this->token_uri,
                'exp' => $now_seconds + (60),
                'iat' => $now_seconds
            ];

            $jwt = JWT::encode($payload, $privateKey, 'RS256');

            $post = [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt
            ];

            $response = $this->guzzle->request('POST', "https://oauth2.googleapis.com/token", [
                'body' =>  json_encode($post),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
            ]);

            $jsonObj = json_decode($response->getBody(), true);

            return $jsonObj['access_token'];
        } catch (\Exception $ex) {
            // do nothing;
        }
    }

    public function sendNotif($body, $access_token)
    {
        try {
            $apiurl = $this->base_url . $this->project_id . '/messages:send';

            $result = $this->guzzle->request('POST', $apiurl, [
                'body' =>  json_encode($body),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token
                ],
            ]);

            $result = json_decode($result->getBody(), true);

            return $result;
        } catch (\Exception $ex) {
            // do nothing;
        }
    }
}
