<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Midwife extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [

        'qualifications',
        'working_status',
 ];
 protected $dates = [ 
   
    'deleted_at',
    'created_at',
];

//relations
public function appointments(){
    return $this->hasMany(Appointment::class);
}
public function user(){
    return $this->belongsTo(User::class);
}

 //Functions/Methods

 public function getMidwives()
 {
    $midwives= Midwife::all();
     return response()->json(['midwives' => $midwives], 200);
 }

 public function getMidwife($midwifeId)
 {
    $midwife = Midwife::find($midwifeId);
   if(!$midwife)
   return response()->json(['error'=>'midwife not found'],404);
   return response()->json(['midwife'=>$midwife],200);
 }

 public function deleteMidwife($midwifeId)
 {
     $midwife = Midwife::find($midwifeId);
    if(!$midwife)
    return response()->json(['error'=>'Midwife not found'],404);
    
    $midwife->delete();
    return response()->json(['message'=>'Midwife deleted succeessfully'],201);
  }

  public function postMidwife(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qualifications' => 'required',
            'working_status' => 'required',
            'user_id' => 'required',
            
        ]);
        
        if ($validator->fails())
        return response()->json(['error' => $validator->errors()]);


        $midwife = Midwife::create(
            [
                'qualifications' => $request->qualifications,
                'working_status '=> $request->working_status,
                'user_id' => $request->user_id,
                
            ] );

            return response()->json(['midwife'=>$midwife],201);
    }
    public function putMidwife(Request $request,$midwifeId)
    {
        $midwife = Midwife::find($midwifeId);
        if(!$midwife)
        return response()->json(['error'=>'midwife not found'],404);
        $midwife->update(
            [
                'qualifications' => $request->qualifications,
                'working_status'=> $request->working_status,
                'user_id' => $request->user_id,
            ]);
            return response()->json(['midwife'=>$midwife],201);
    }

}

