<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GuzzleHttp;

trait IssueTokenTrait
{

    /**
     * @param Request $request
     * @param $grantType
     * @param string $scope
     * @return mixed
     */
    public function issueToken(Request $request, $grantType, $scope = "")
    {
        $params = [
            'grant_type' => $grantType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'scope' => $scope
        ];

        $params['username'] = $request->username ?: $request->email;

        $url = url('/oauth/token');
        $headers = ['Accept' => 'application/json'];
        $http = new GuzzleHttp\Client;

        $response = $http->post($url, [
            'headers' => $headers,
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $this->client->id,
                'client_secret' => $this->client->secret,
                'username' => $request->email,
                'password' => $request->password
            ],
        ]);

        return json_decode((string)$response->getBody(), true);

//    	$request->request->add($params);
//    	$proxy = Request::create('oauth/token', 'POST');
//    	return Route::dispatch($proxy);
    }

}