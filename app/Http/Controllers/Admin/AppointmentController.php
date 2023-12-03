<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AppointmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {

        return Appointment::query()
            ->with('client:id,first_name,last_name')
            ->when(request('status'), function($query){
                return $query->where('status', AppointmentStatus::from(request('status')));
            })
            ->latest()
            ->paginate()
            ->through(fn ($appointment)=> [
                'id' => $appointment->id,
                'start_time' => $appointment->start_time->format('d.m.Y h:i A'),
                'end_time' => $appointment->end_time->format('d.m.Y h:i A'),
                'status' => [
                    'name' => $appointment->status->name,
                    'color' => $appointment->status->color(),
                ],
                'client' => $appointment->client,
            ]);
    }

    public function store()
    {
        $validated = request()->validate([
           'title' => 'required',
           'description' => 'required',
           'start_time' => 'required',
           'end_time' => 'required',
           'client_id' => 'required',
        ],
        [
            'client_id.required' => 'The client name field is required.'
        ]);

        Appointment::create([
            'title' => $validated['title'],
            'client_id' => $validated['client_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'description' => $validated['description'],
            'status' => AppointmentStatus::SCHEDULED,
        ]);

        return response()->json(['message' => 'success']);
    }
}
