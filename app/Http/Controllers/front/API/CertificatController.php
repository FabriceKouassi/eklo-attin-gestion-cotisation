<?php

namespace App\Http\Controllers\front\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CertificatController extends Controller
{
    protected $api_url; // = env('APP_API_INHP_URL');

    public function __construct() {
        $this->api_url = env('APP_API_INHP_URL');
    }

    public function api_certificat()
    {
        $response = Http::get($this->api_url);

        if ($response->successful()) return response()->json([
            'data' => $response->json()
        ]);
        else
        return response()->json([
            'error' => 'Une erreur est survenue lors de la récupération des données'
        ], 500);

        // return $response->json();
    }
}
