<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use GuzzleHttp\Client;
use Guzzle\Http\Message\Response;

class HeadquartersController extends Controller
{
    // The functionality that HQ needs to monitor the park

    // 
    public function commandCentral()
    {
        //If this doesn't work it might be same as the GC method! **
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
        info($thingToDecode);

        $jsonObject = json_decode($thingToDecode, true);

        return view('cameras.multipleCamerasView', ['cameras' => $jsonObject]);
    }

    // 
    public function addDevice()
    {
        return view('cameras.addNew');
    }

    // 
    public function storeDevice()
    {
        $apiRoute = 'addCamera';

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:1234/']);
        $json = [
    'json' => [
                            'deviceType' => request('deviceType'),
                            'xLocation' => request('xLocation'),
                            'yLocation' => request('yLocation'),
                            'status' => request('status'),
                            'dataLinkType' => request('dataLinkType'),
                            'dataLink' => request('dataLink')
                        ]
   ]; 

        //This is to get the actual JSON of the message
        $response = $client->post($apiRoute, $json);
        info("Yo yo yo");

        return redirect()->route('headquarters');
    }

    // 
    public function assignCamera()
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
    public function store()
    {
       // Overlaps with a ranger route

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

    // 
    public function removeCamera($id)
    {
        return $this->remove($id);
    }

    // 
    public function remove($id)
    {
        $apiRoute = 'cameras/'.$id;
        $client = new Client(['base_uri' => 'http://localhost:1234/']);
        
        //Make the delete camera request
        $response = $client->delete($apiRoute);
        info("Yo yo yo");

        return redirect()->route('headquarters');
    }

    // Change JSON parameters**
    public function makeMoveRequest()
    {
        $apiRoute = 'makeMove';
        $client = new Client(['base_uri' => 'http://localhost:1234/']);
        $json = [
    'json' => [
                            'firstName' => $firstName,
                            'lastName' => $lastName,
                            'username' => $username,
                            'password' => $password
                        ]
   ]; 

        //Make the post request
        $response = $client->patch($apiRoute, $json);
        info("Yo yo yo");

        return redirect()->route('headquarters');
    }
}
