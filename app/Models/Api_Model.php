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
        $this->apiUrl = 'http://103.78.24.206/gki_api/public/api/jemaat/';
        $this->apiKey = 'gki';
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
    public function postToApiFile($endpoint, $data)
    {
        $url = $this->apiUrl . $endpoint;

        $client = \Config\Services::curlrequest();
        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'multipart' => $data,
        ]);

        return $response->getBody();
    }

    public function postToApiWithFile($endpoint, $data, $fileFieldName, $filePath)
    {
        $url = $this->apiUrl . $endpoint;
        $client = \Config\Services::curlrequest();

        $multipart = [
            [
                'name' => $fileFieldName,
                'content' => fopen($filePath, 'r'),
                'filename' => basename($filePath),
            ],
        ];

        foreach ($data as $key => $value) {
            $multipart[] = ['name' => $key, 'content' => $value];
        }

        $response = $client->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'multipart' => $multipart,
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