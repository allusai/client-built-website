<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Log;
use GuzzleHttp\Client;

// Handles when the user initially starts using the Safari website

class LoginController extends Controller
{

	// 
    public function index()
    {
    	return view('intro.welcome');
    }

    // 
    public function login()
    {
    	return view('intro.login');
    }

    //
    public function doLogin()
    {
        $apiRoute = 'login';

        $username = request('username');
        $password = request('password');

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://localhost:1234/']);
        $json = [
    'json' => [
                            'username' => $username,
                            'password' => $password
                        ]
   ]; 

        //This is to get the actual JSON of the message
        $response = $client->post("/login", $json);
        $body = $response->getBody();
        $stringBody = (string) $body;
        info($stringBody);

        //Get this new ranger's id
        $id = $stringBody;
        info($id);

        $cams = $client->get("/rangers/".$id);
        // Send a request to https://foo.com/api/test
        //$response = $client->post($apiRoute, $json
                //);

        return view('rangers.dashboard', ['cameras' => $cams]);
    }

    // 
    public function signup()
    {
    	return view('intro.signup');
    }

    // 
    public function store()
    {
    	//$response = $client->post('http://httpbin.org/post');
    	$apiRoute = 'addRanger';

    	$firstName = request('firstName');
    	$lastName = request('lastName');
    	$username = request('username');
    	$password = request('password');

    	// Create a client with a base URI
		$client = new Client(['base_uri' => 'http://localhost:1234/']);
		$json = [
    'json' => [
					        'firstName' => $firstName,
					        'lastName' => $lastName,
					        'username' => $username,
					        'password' => $password
					    ]
   ]; 

        //This is to get the actual JSON of the message
		$response = $client->post("/addRanger", $json);
        $body = $response->getBody();
        $stringBody = (string) $body;
        info($stringBody);

        //Get this new ranger's id
        $id = $stringBody;
        info($id);

        $cams = $client->get("/rangers/".$id);
		// Send a request to https://foo.com/api/test
		//$response = $client->post($apiRoute, $json
				//);

		return view('rangers.dashboard', ['cameras' => $cams]);
    }
}
