<?php

namespace App\Http\Controllers\ApiAuth;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Laravel\Passport\Client;
use App\Http\Traits\IssueTokenTrait;

class RegisterController extends Controller
{
    use IssueTokenTrait;

    /**
     * @var
     */
    private $client;

    /**
     * RegisterController constructor.
     */
    public function __construct(){
        $this->client = Client::find(2);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        return $this->issueToken($request, 'password');
    }

}