<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class GunBrokerController extends Controller
{
    
protected $accessToken;
  
    public function __construct() {
        $this->getAccessToken();
    }
    public function getItem($itemId) {
        $client = new Client();

        try {
            $response = $client->request('GET', "https://api.gunbroker.com/v1/Items/{$itemId}", [
                'headers' => [
                    'X-DevKey' => '5cb51112-79f5-4959-ab0e-344901c260a9',
                    'X-AccessToken' => $this->accessToken,
                ],
                'verify' => false,
            ]);
    
            $response_data = json_decode($response->getBody(), true);
            
            if (isset($response_data)) {
                return response()->json(['data' => $response_data]);
            } else {
                return response()->json(['error' => 'Item not found or other error']);
            }
        } catch (GuzzleException $e) {
            return response()->json(['error' => 'Item not found or other error']);
        }
    }

    public function getItems(Request $request) {
        $client = new Client();
        $queryString = $request->getQueryString();
        
        try {
            $response = $client->request('GET', "https://api.gunbroker.com/v1/ItemsSelling?" . $queryString, [
                'headers' => [
                    'X-DevKey' => '5cb51112-79f5-4959-ab0e-344901c260a9',
                    'X-AccessToken' => $this->accessToken,
                ],
                'verify' => false,
            ]);
    
            $response_data = json_decode($response->getBody(), true);
    
                return response()->json(['data' => $response_data['results']]);

        } catch (GuzzleException $e) {
            return response()->json(['error' => 'Items not found or other error']);
        }
    }

    public function getSold(Request $request) {
        $client = new Client();
        $queryString = $request->getQueryString();
        
        try {
            $response = $client->request('GET', "https://api.gunbroker.com/v1/ItemsEnded?" . $queryString, [
                'headers' => [
                    'X-DevKey' => '5cb51112-79f5-4959-ab0e-344901c260a9',
                    'X-AccessToken' => $this->accessToken,
                ],
                'verify' => false,
            ]);
    
            $response_data = json_decode($response->getBody(), true);
    
                return response()->json(['data' => $response_data['results']]);

        } catch (GuzzleException $e) {
            return response()->json(['error' => 'Items not found or other error']);
        }
    }

    public function getScheduled(Request $request) {
        $client = new Client();
        $queryString = $request->getQueryString();
        
        try {
            $response = $client->request('GET', "https://api.gunbroker.com/v1/ItemsScheduled?" . $queryString, [
                'headers' => [
                    'X-DevKey' => '5cb51112-79f5-4959-ab0e-344901c260a9',
                    'X-AccessToken' => $this->accessToken,
                ],
                'verify' => false,
            ]);
    
            $response_data = json_decode($response->getBody(), true);
    
                return response()->json(['data' => $response_data['results']]);

        } catch (GuzzleException $e) {
            return response()->json(['error' => 'Items not found or other error']);
        }
    }
    

    private function getAccessToken()
    {
        $client = new Client();

        try {
            $response = $client->request('POST', 'https://api.gunbroker.com/v1/Users/AccessToken', [
                'form_params' => [
                    'Username' => 'izzyisbizzy',
                    'Password' => '#+~HN54?dxroeC706EBRu'
                ],
                'headers' => [
                    'X-DevKey' => '5cb51112-79f5-4959-ab0e-344901c260a9',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'verify' => false,
            ]);

            $response_data = json_decode($response->getBody(), true);
        
            if (isset($response_data["accessToken"])) {
                $this->accessToken = $response_data["accessToken"];
            } else {
                echo "No accessToken found in the response.";
                return null;
            }
        } catch (GuzzleException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
