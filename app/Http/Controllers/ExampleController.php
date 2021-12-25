<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ExampleController extends Controller
{

    private Client $client;

    /**
     * Create a new controller instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index() {

        $url = '';

        try {
            $response = (new Client)->get($url);

            dd($response->getStatusCode());

            return true;
        } catch (GuzzleException $e) {
        }

        return false;
    }

    //
}
