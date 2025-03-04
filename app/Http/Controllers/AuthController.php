<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\HttpResponses;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\SigninRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\SigninResource;
use Illuminate\Notifications\Notifiable;
use App\Http\Requests\PasswordChangeRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthController extends Controller
{
    use HasApiTokens, HasFactory, Notifiable, HttpResponses;

    protected  $user;

    public function __construct(UserService $user)
    {

        $this->user = $user;
    }

    public function signin(SigninRequest $request)
    {
        $validatedData = $request->validated();

        $user = $this->user->getUserByEmail($request->email);

        if (!$user || !Hash::check($validatedData["password"], $user->password)) {
            return $this->fail('authentication-failed', null, "Credential not matched", 401);
        }

        return $this->success("success",["user" => SigninResource::make($user),"token"=>$user->createToken(time())->plainTextToken],"Login Successful",200);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $request->user()->currentAccessToken()->delete();

        return $this->success("success", null, "Logout success", 200);
    }

    public function changePassword(PasswordChangeRequest $request){
        $user=auth()->user;
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect',
                'status' => 'error',
            ], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save;
        $user->currentAccessToken()->delete();

        return response()->json([
            "status"  => true,
            'statusCode' => 200,
            "message" => "Password Changed Successfully. Login again",
        ], 200);
    }
}
