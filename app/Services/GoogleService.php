<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\User;

class GoogleService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function refreshAccessToken(User $user)
    {
        $response = $this->client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'refresh_token' => $user->google_refresh_token,
                'grant_type' => 'refresh_token',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        $user->google_token = $data['access_token'];
        $user->save();

        return $data['access_token'];
    }

    public function makeApiRequest($accessToken)
    {
        $response = $this->client->get('https://www.googleapis.com/oauth2/v1/userinfo', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
