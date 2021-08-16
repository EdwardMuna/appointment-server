<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;

class MotherController extends Controller
{
    protected $midwifeModel;

    //Here we construct controllers now

    public function __construct()
    {
      $this->motherModel = new Mother();
    }
    //controller yakuget mothers
    public function getMothers()
    {
        return $this->motherModel->getMothers();
    }
    //contoller yakuget mother yenye id fulani
    public function getMother($motherId)
    {
        return $this->motherModel->getMother($motherId);
    }
    //controller yakudelete mother
    public function deleteMother($motherId)
    {
        return $this->motherModel->deleteMother($motherId);
    }
    //c
    public function postMother(Request $request)
    {
        return $this->motherModel->postMother($request);
    }
    public function putMother(Request $request,$motherId)
    {
        return $this->motherModel->putMother($request,$motherId);
    }
}
