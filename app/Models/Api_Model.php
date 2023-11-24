<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class Api_Model extends Model
{
    protected $apiUrl;
    protected $apiKey;
    public function __construct()
    {
        $this->apiUrl = 'http://103.83.7.7/gki_api/public/api/jemaat/';
        $this->apiKey = 'gki';
    }

    public function requestApi($method, $endpoint, $data = [])
    {
        $client = Services::curlrequest();
        $url = $this->apiUrl . $endpoint;

        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ];

        if ($method === 'GET') {
            $response = $client->request($method, $url, $options);
        } else {
            $options['form_params'] = $data;
            $response = $client->request($method, $url, $options);
        }

        $statusCode = $response->getStatusCode();

        if ($statusCode == 200) {
            $body = $response->getBody();
            return json_decode($body, true); // Mengonversi JSON menjadi array
        } else {
            return null;
        }
    }

    public function postToApi($endpoint, $data)
    {
        $url = $this->apiUrl . $endpoint;

        $client = \Config\Services::curlrequest();
        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'form_params' => $data,
        ]);

        return $response->getBody();
    }

    public function getToApi($endpoint)
    {
        $url = $this->apiUrl . $endpoint;

        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);

        $response = $response->getBody();
        return json_decode($response, true);
    }
}