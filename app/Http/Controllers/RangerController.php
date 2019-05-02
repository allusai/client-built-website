<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use GuzzleHttp\Client;
use Guzzle\Http\Message\Response;

class RangerController extends Controller
{
    // Handles the functionality that rangers can use in the field

    // 
    public function myCameras(Request $request)
    {
        $id = $request->input('id');//*If no request, it goes to /rangers
        $apiRoute = 'rangers/'.$id;
        info("Single ranger view, api route is: " . $apiRoute);

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:1234/']);


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
    public function addNewCamerasForSelf()
    {
        $apiRoute = 'cameras';
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
        //info($thingToDecode);

        $jsonObject = json_decode($thingToDecode, true);


        $apiRoute = 'rangers';
        $client = new Client(['base_uri' => 'http://localhost:1234/']);

        //Getting and formatting the response
        $response = $client->get($apiRoute); //Response made json again
        $responseContents = (string) $response->getBody(); //Now string
       
       // Priority 1
        $rangers = '';
        $slashCounter = 0;
        for($i = 1; $i < strlen($responseContents)-1; $i++) {
            if($responseContents[$i] != '\\') {
                $rangers = $rangers.$responseContents[$i];
            }
            else {
                $slashCounter++;
            }
        }
        //info($rangers);

        $rangersList = json_decode($rangers, true);

        return view('rangers.assignCamera', ['cameras' => $jsonObject,
            'rangers' => $rangersList]);
    }

    // 
    public function storeNewCameras()
    {
        $cameras = $_POST['cameras_selected'];
        $apiRoute = 'assignCamera';
        $client = new Client(['base_uri' => 'http://localhost:1234/']);


        info(request('ranger'));

        for($j = 0; $j < count($cameras); $j++) {
           $camera = $cameras[$j];
           info("Yo");
           $json = [
    'json' => [
                            'rangerId' => request('ranger'),
                            'deviceId' => $camera
                        ]
   ]; 
            info($json);
            $response = $client->post($apiRoute, $json);


        }

        return redirect()->route('dashboard', ['id'=>request('ranger')]);

    }

}
