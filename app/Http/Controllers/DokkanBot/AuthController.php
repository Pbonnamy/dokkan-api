<?php

namespace App\Http\Controllers\DokkanBot;

use App\Clients\DokkanClient;
use App\Http\Controllers\Controller;
use Exception;

class AuthController extends Controller
{
    public function signup()
    {
        try {
            $data = [];

            return app(DokkanClient::class)->signup($data);
        }   catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
