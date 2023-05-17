<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BsiApiClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('bsi_api.base_uri'),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getToken(),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getToken()
    {
        $client = new Client([
            'base_uri' => config('bsi_api.base_uri'),
            'timeout' => 10, // timeout dalam detik
        ]);
    
        try {
            $response = $client->post('/api/auth/token', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode(config('bsi_api.client_id') . ':' . config('bsi_api.client_secret')),
                ],
                'json' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);
    
            $responseData = json_decode($response->getBody(), true);
    
            return $responseData['access_token'];
        } catch (GuzzleException $e) {
            // Handle exception
            return null;
        }
    }

    public function createTransaction($data)
    {
        $url = $this->base_url . '/transaction';

        $payload = [
            'date' => $data['date'],
            'amount' => $data['amount'],
            'customer' => [
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
            ],
            'payment' => [
                'type' => 'VA',
                'va' => $data['va'],
                'number' => $data['number'],
                'attribute1' => $data['attribute1'],
                'attribute2' => $data['attribute2'],
            ],
            'items' => $data['items'],
            'attributes' => $data['attributes'],
        ];

        $response = $this->client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $payload,
        ]);

        return $response->getBody()->getContents();
    }
  

    public function getTransactionStatus($transactionId)
    {
        $response = $this->client->request('GET', "/transactions/{$transactionId}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getToken(),
                'Accept' => 'application/json',
            ],
        ]);
    
        return json_decode($response->getBody(), true);
    }

    public function settlementTransaction($transactionId, $amount)
    {
        $response = $this->client->request('POST', "/transactions/{$transactionId}/settlements", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getToken(),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'amount' => $amount,
            ],
        ]);
    
        return json_decode($response->getBody(), true);
    }
}
