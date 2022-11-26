<?php

namespace App\Clients;

use Exception;
use Illuminate\Support\Facades\Http;

class DokkanClient
{
    protected $url;
    protected $version;

    public function __construct($url, $version)
    {
        $this->url = $url;
        $this->version = $version;
    }

    private function callApi($method, $path, $data = [])
    {
        $headers = [
            'X-ClientVersion' => $this->version,
        ];

        $response = Http::withHeaders($headers)->$method($this->url . $path, $data);

        if ($response->failed()) {
            throw new Exception('Impossible de contacter le serveur');
        } else {
            return $response->json();
        }
    }

    public function ping()
    {
        $method = 'GET';
        $path = '/ping';

        return $this->callApi($method, $path);
    }
}