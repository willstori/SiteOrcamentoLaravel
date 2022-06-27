<?php
namespace App\Services\Admin;

interface IUserService
{
    public function storeUser($request);
    public function updateUser($request, $user);
    public function destroyUser($user);
}
