<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\ServiceSchedule;
use Carbon\Carbon;

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

        return ['schedule' => $user->schedule];
    }
}
