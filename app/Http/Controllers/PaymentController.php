<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $midwifeModel;

    //Here we construct controllers now

    public function __construct()
    {
      $this->paymentModel = new Payment();
    }
    //controller yakuget payments
    public function getPayments()
    {
        return $this->paymentModel->getPayments();
    }
    //contoller yakugetpayment yenye id fulani
    public function getPayment($paymentId)
    {
        return $this->paymentModel->getPayment($paymentId);
    }
    //controller yakudelete payment
    public function deletePayment($paymentId)
    {
        return $this->paymentModel->deletePayment($paymentId);
    }
    //controller yaku create payment
    public function postPayment(Request $request)
    {
        return $this->paymentModel->postPayment($request);
    }
    //CONTROLLER YAKU UPDATE PAYMENT

    public function putPayment(Request $request,$paymentId)
    {
        return $this->paymentModel->putPayment($request,$paymentId);
    }
}
