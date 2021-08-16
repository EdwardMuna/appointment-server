<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Payment extends Model
{
    use HasFactory; 
    use SoftDeletes;

    protected $fillable = [

        'status_disbursement',   
];
protected $dates = [ 
   
    'deleted_at',
    'created_at',
];

//relationships

public function appointment(){
    return $this->belongsTo(Appointment::class);
}

 //Functions/Methods

 public function getPayments()
 {
    $payment= Payment::all();
     return response()->json(['payment' => $payment], 200);
 }

 public function getPayment($paymentId)
 {
    $payment = Payment::find($paymentId);
   if(!$payment)
   return response()->json(['error'=>'payment not found'],404);
   return response()->json(['payment'=>$payment],200);
 }

 public function deletePayment($paymentId)
 {
     $payment = Payment::find($paymentId);
    if(!$payment)
    return response()->json(['error'=>'Payment not found'],404);
    
    $payment->delete();
    return response()->json(['message'=>'Payment deleted succeessfully'],201);
  }

  public function postPayment(Request $request)
  {
      $validator = Validator::make($request->all(),
      [
         'status_disbursement' =>'required',
         'appointment_id'=>'required',           
      ]);

      if($validator->fails())
      return response()->json(['errror'=>$validator->errors()]);

       $payment = Payment::create(
           [
               'status_disbursement'=>$request->status_disbursement,
               'appointment_id'=>$request->appointment_id,
           ]);

           return response()->json(['payment'=>$payment],201);
  }
 
  public function putPayment(Request $request,$paymentId)
  {
      $payment = Payment::find($paymentId);
      if(!$payment)
      return response()->json(['error'=>'payment not found'],404);
      $payment->update(
          [
            'status_disbursement'=>$request->status_disbursement,
               'appointment_id'=>$request->appointment_id,
          ]);
          return response()->json(['payment'=>$payment],201);
  }
}


