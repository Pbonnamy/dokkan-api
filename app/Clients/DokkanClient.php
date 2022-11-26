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
        $this->platform = 'android';
    }

    private function callApi($method, $path, $data = [])
    {
        $headers = [
            'X-ClientVersion' => $this->version,
            'X-Platform' => $this->platform,
        ];

        $response = Http::withHeaders($headers)->$method($this->url . $path, $data);

        if ($response->failed()) {
            throw new Exception('Une erreur est survenue');
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

    public function signup($data)
    {
        $method = 'POST';
        $path = '/auth/signup';

        return $this->callApi($method, $path, $data);
    }
}