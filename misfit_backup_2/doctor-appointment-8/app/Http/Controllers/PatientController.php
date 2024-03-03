<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class PatientController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function PatientDashboard()
    {
        $notifications = $this->request->user()->unreadNotifications;

        return view('patient.patient_dashboard', ['notifications' => $notifications]);
    }

    public function PatientAppointments(){
        $notifications = $this->request->user()->unreadNotifications;
        $appointments = Appointment::where('user_id', Auth::user()->id)->get();
        return view('patient.patient_dashboard_appointments', compact('appointments','notifications'));
    }
    
}

