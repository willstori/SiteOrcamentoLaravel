<?php

namespace App\Services\Admin;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserService  implements IUserService
{
    public function storeUser($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
    }

    public function updateUser($request, $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;

        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->update();
    }

    public function destroyUser($user)
    {
        $user->delete();
    }
}
