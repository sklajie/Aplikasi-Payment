<?php

namespace App\Services;

use GuzzleHttp\Client;

class BillingApi
{
    public function createTransaction(array $data)
    {
        $client = new Client([
            'base_uri' => 'https://bsi-billingservice.com/api/',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        $requestBody = [
            'date' => $data['date'],
            'amount' => $data['amount'],
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'va' => $data['va'], // menggunakan nomor VA dari data Pendaftaran Mahasiswa Baru
            'number' => $data['number'],
            'attribute1' => $data['attribute1'],
            'attribute2' => $data['attribute2'],
            'sequenceNumber' => $data['sequenceNumber'],
            'items' => $data['items'],
            'attributes' => $data['attributes'],
        ];

        $response = $client->post('transaction', [
            'json' => $requestBody,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return [
            'transactionId' => $responseBody['transactionId'],
        ];
    }
}
