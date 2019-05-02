<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use GuzzleHttp\Client;
use Guzzle\Http\Message\Response;

class GeneralController extends Controller
{
    // Handles API calls that a ranger or the headquarters can both make

// Single Camera View
    public function singleCameraView($id)
    {
        //$response = $client->post('http://httpbin.org/post');
        $apiRoute = 'cameras/'.$id;
        info("Single camera view, api route is: " . $apiRoute);

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:1234/', 'headers' => [
'Accept' => 'application/json',
'Content-type' => 'application/json'
]]);

        info("cookie");
        //No JSON is required for this route, just the route itself!
        $response = $client->get($apiRoute);
        $responseContents = (string) $response->getBody();
        
        $thingToDecode = '';
        $slashCounter = 0;
        for($i = 1; $i < strlen($responseContents)-1; $i++) {
            if($responseContents[$i] != '\\') {
                $thingToDecode = $thingToDecode.$responseContents[$i];
            }
            else {
                $slashCounter++;
            }
        }
        info($thingToDecode);

        $jsonObject = json_decode($thingToDecode, true);
        

        return view('cameras.singleCameraView', ['camera' => $jsonObject]);
    }




// All cameras for a ranger
    public function singleRangerView($id) 
    {
        $apiRoute = 'rangers/'.$id;
        info("Single ranger view, api route is: " . $apiRoute);

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:1234/', 'headers' => [
'Accept' => 'application/json',
'Content-type' => 'application/json'
]]);
        info("cookie");

        $response = $client->get($apiRoute); //Response made json again
        $responseContents = (string) $response->getBody(); //Now string
        
        $thingToDecode = '';
        $slashCounter = 0;
        for($i = 1; $i < strlen($responseContents)-1; $i++) {
            if($responseContents[$i] != '\\') {
                $thingToDecode = $thingToDecode.$responseContents[$i];
            }
            else {
                $slashCounter++;
            }
        }
        // Indexes might be different for array
        info($thingToDecode);

        $jsonObject = json_decode($thingToDecode, true);

        return view('cameras.multipleCamerasView', ['cameras' => $jsonObject]);
    }




    // 
    public function rangerList() 
    {
        $apiRoute = 'rangers';
        $client = new Client(['base_uri' => 'http://localhost:1234/']);

        //Getting and formatting the response
        $response = $client->get($apiRoute); //Response made json again
        $responseContents = (string) $response->getBody(); //Now string
       
       // Priority 1
        $thingToDecode = '';
        $slashCounter = 0;
        for($i = 1; $i < strlen($responseContents)-1; $i++) {
            if($responseContents[$i] != '\\') {
                $thingToDecode = $thingToDecode.$responseContents[$i];
            }
            else {
                $slashCounter++;
            }
        }
        info($thingToDecode);

        $jsonObject = json_decode($thingToDecode, true);

        return view('rangers.listView', ['rangers' => $jsonObject]);
    }

    // 
    public function rechargeList() 
    {
        $apiRoute = 'rechargeList';
        $client = new Client(['base_uri' => 'http://localhost:1234/']);

        //Getting and formatting the response
        $response = $client->get($apiRoute); //Response made json again
        $responseContents = (string) $response->getBody(); //Now string
       
       // Priority 1
        $thingToDecode = '';
        $slashCounter = 0;
        for($i = 1; $i < strlen($responseContents)-1; $i++) {
            if($responseContents[$i] != '\\') {
                $thingToDecode = $thingToDecode.$responseContents[$i];
            }
            else {
                $slashCounter++;
            }
        }
        info($thingToDecode);

        $jsonObject = json_decode($thingToDecode, true);

        return view('cameras.rechargingView', ['rechargeList' => $jsonObject]);
    }


    // 
    public function makeRechargeRequest($id) 
    {
        $apiRoute = 'recharge/'.$id;
        $client = new Client(['base_uri' => 'http://localhost:1234/']);

        //Make the post request
        $response = $client->post($apiRoute);
        info("Yo yo yo");

        return redirect()->route('rechargeList');
    }

    // 
    public function deployCall($id) 
    {
        $apiRoute = 'deploy/'.$id;
        $client = new Client(['base_uri' => 'http://localhost:1234/']);

        //Make the post request
        $response = $client->post($apiRoute);
        info("Yo yo yo");

        return redirect()->route('rechargeList');
    }
}
