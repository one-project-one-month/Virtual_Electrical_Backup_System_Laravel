<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\HttpResponses;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SigninRequest;
use App\Http\Resources\LoginResorce;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\SigninResource;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthController extends Controller
{
    use HasApiTokens, HasFactory, Notifiable, HttpResponses;

    protected  $user;

    public function __construct(UserService $user)
    {

        $this->user = $user;
    }

    public function signin(SigninRequest $request){
        $validatedData = $request->validated();

        $user = $this->user->getUserByEmail($request->email);

        if(!$user || !Hash::check($validatedData["password"],$user->password)){
            return $this->fail('authentication-failed',null,"Credential not matched",401);
        }

        return $this->success("success",[SigninResource::make($user),"token"=>$user->createToken(time())->plainTextToken],"Login Successful",200);

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        $request->user()->currentAccessToken()->delete();

        return $this->success("success",null,"Logout success",200);
    }
}
