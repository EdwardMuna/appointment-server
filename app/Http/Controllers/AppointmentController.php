<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentModel;

    //Here we construct controllers now

    public function __construct()
    {
      $this->appointmentModel = new Appointment();
    }
    //controller yakuget appointments
    public function getAppointments()
    {
        return $this->appointmentModel->getAppointments();
    }
    //contoller yakuget appointment yenye id fulani
    public function getAppointment($appointmentId)
    {
        return $this->appointmentModel->getAppointment($appointmentId);
    }
    //controller yakudelete appointment
    public function deleteAppointment($appointmentId)
    {
        return $this->appointmentModel->deleteAppointment($appointmentId);
    }
    public function postAppointment(Request $request)
    {
        return $this->appointmentModel->postAppointment($request);
    }
    public  function putAppointment(Request $request,$appointmentId)
    {
        return $this->appointmentmodel->putAppointment($request, $appointmentId);
    }
}
