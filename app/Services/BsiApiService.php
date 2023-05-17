<?php

namespace App\Services;

use GuzzleHttp\Client;

class BsiApiService
{
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = env('BSI_API_ENDPOINT');
    }

    public function authenticate()
    {
        $response = $this->client->request('POST', $this->baseUrl . '/auth', [
            'form_params' => [
                'client_id' => env('BSI_API_CLIENT_ID'),
                'client_secret' => env('BSI_API_CLIENT_SECRET'),
                'grant_type' => 'client_credentials',
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['access_token'];
    }
}
