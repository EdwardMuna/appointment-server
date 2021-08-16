<?php

namespace App\Http\Controllers;

use App\Models\Midwife;
use Illuminate\Http\Request;

class MidwifeController extends Controller
{
    protected $midwifeModel;

    //Here we construct controllers now

    public function __construct()
    {
      $this->midwifeModel = new Midwife();
    }
    //controller yakuget midwives
    public function getMidwives()
    {
        return $this->midwifeModel->getMidwives();
    }
    //contoller yakuget midwife mwenye id fulani
    public function getMidwife($midwifeId)
    {
        return $this->midwifeModel->getMidwife($midwifeId);
    }
    //controller yakudelete midwife
    public function deleteMidwife($midwifeId)
    {
        return $this->midwifeModel->deletemidwife($midwifeId);
    }
    public function postMidwife(Request $request)
    {
        return $this->midwifeModel->postMidwife($request);
    }
    public function putMidwife(Request $request,$midwifeId)
    {
        return $this->midwifeModel->putMidwife($request,$midwifeId);
    }
}
