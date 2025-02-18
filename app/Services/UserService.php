<?php

namespace App\Services;

use App\Models\User;
use App\Services\CommonService;

class UserService extends CommonService
{
    public function connection(){
        return new User();
    }

    // get user data by email for signin process
    public function getUserByEmail($email)
    {
        return $this->connection()->query()->where('email', $email)->first();

    }

}
