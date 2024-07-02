<?php

namespace App\Listeners;

use Illuminate\Support\Carbon;
use App\Events\BookedAppointmant;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Services\Email\EmailService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailToClientAppointment implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookedAppointmant $event): void
    {
        $messageServiceSample = new EmailService();

        $details = [
            'title' => ' وقت رزرو شده با دکتر'.$event->consultant->fullname, 
            'body' => "وقت شما ".$event->detail->nameWeek.' ساعت'.Carbon::parse($event->detail->start_time)->format('H:i'),
        ];

        $messageServiceSample->setTo($event->client->email);
        $messageServiceSample->setFrom('dokhtarooone@zaaaanooone.ir','test-project');
        $messageServiceSample->setDetails($details);
        $messageServiceSample->setSubject('کد احراز هویت شما');


        $messageServiceSample->fire();
    }
}
