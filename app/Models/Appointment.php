<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'booking_status',
        'price',
        'location',
        'longitude',
        'latitude',
        'date',
        'time',
        'mother_id',
        'midwife_id',
    ];
    protected $dates = [
        'date',
        'deleted_at',
        'created_at',
    ];

    //relations
    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }
    public function midwife()
    {
        return $this->belongsTo(Midwife::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    //Functions/Methods

    public function getAppointments()
    {
        $appointments = Appointment::all();
        return response()->json(['appointments' => $appointments], 200);
    }

    public function getAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if (!$appointment)
            return response()->json(['error' => 'appointment not found'], 404);
        return response()->json(['appointment' => $appointment], 200);
    }

    public function deleteAppointment($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if (!$appointment)
            return response()->json(['error' => 'appointment not found'], 404);

        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted succeessfully'], 201);
    }

    public function postAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_status' => 'required',
            'price' => 'required',
            'date' => 'required',
            'time' => 'required',
            'mother_id' => 'required',
            'midwife_id' => 'required',
        ]);

        if ($validator->fails())
            return response()->json(['error' => $validator->errors()]);


        $appointment = Appointment::create(
            [
                'booking_status' => $request->booking_status,
                'price' => $request->price,
                'date' => $request->date,
                'time' => $request->time,
                'mother_id' => $request->mother_id,
                'midwife_id' => $request->midwife_id,
            ]
        );

        return response()->json(['appointment' => $appointment], 201);
    }
    public function putAppointment(Request $request, $appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if (!$appointment)
            return response()->json(['error' => 'appointment not found'], 404);
        $appointment->update(
            [
                'booking_status' => $request->booking_status,
                'price' => $request->price,
                'location' => $request->location,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'date' => $request->date,
                'time' => $request->time,
                'mother_id' => $request->mother_id,
                'midwife_id' => $request->midwife_id,
            ]);
       
        return response()->json(['appointment' => $appointment], 201);
    }
}
