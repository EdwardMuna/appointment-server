<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    protected $midwifeModel;

    //Here we construct controllers now

    public function __construct()
    {
      $this->userModel = new User();
    }
    //controller yakuget users
    public function getUsers()
    {
        return $this->userModel->getUsers();
    }
    //contoller yakuget user yenye id fulani
    public function getUser($userId)
    {
        return $this->userModel->getUser($userId);
    }
    //controller yakudelete user
    public function deleteUser($userId)
    {
        return $this->userModel->deleteUser($userId);
    }
    public function postUser(Request $request)
    {
        return $this->userModel->postUser($request);
    }
    public function putUser(Request $request,$userId)
    {
        return $this->userModel->putUser($request,$userId);
    }
    public function register(Request $request)
    {
        return $this->userModel->register($request);
    }
}
