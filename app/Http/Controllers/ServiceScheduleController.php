<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ServiceSchedule;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;

use App\Mail\scheduledCall;

class ServiceScheduleController extends Controller
{
    public function getCalledNow(Request $request)
    {

        $user = auth()->user();

        $schedule = ServiceSchedule::updateOrCreate([
            'user_id' => $user->id,
            'waiting_for_call' => true,
        ]);

        return ['schedule' => $user->schedule];
    }

    public function scheduleCall(Request $request)
    {
        
        $data = $this->validate($request,[
            'call_scheduled_at' => 'required',
        ]);
        $user = auth()->user();

        $schedule = ServiceSchedule::updateOrCreate(
            [ 
                'user_id' => $user->id
            ],
            [
                'waiting_for_call' => true,
                'call_scheduled_at' => $data['call_scheduled_at'],
            ],
        );

        $account =
            [
                'user' => $user,
                'profile' => $user->profile,
                'call_scheduled_at' => $data['call_scheduled_at'],
            ];

        Mail::to('office@nrecycli.com') 
            ->send(new scheduledCall( $account ));

        return ['schedule' => $user->schedule];
    }
}
