<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class Instagram {

    var $appId = '';
    var $secret = '';
    var $redirectUri = '';

    public function __construct() {
        $this->appId = config('services.instagram.client_id');
        $this->secret = config('services.instagram.client_secret');
        $this->redirectUri = config('services.instagram.redirect');
    }

    public function getAccessToken($code) {

        $client = new Client();
        $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
            'form_params' => [
                'app_id' => $this->appId,
                'app_secret' => $this->secret,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirectUri,
                'code' => $code,
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            return $response->getBody()->getContents();
        }
        return null;
    }

    public function getUserInfo($accessToken)
    {
        $client = new Client();
        $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,account_type&access_token={$accessToken}");

        if ($response->getStatusCode() == 200) {
            return $response->getBody()->getContents();
        }
        return null;

    }

}