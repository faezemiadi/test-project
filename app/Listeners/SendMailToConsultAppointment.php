<?php

namespace App\Listeners;

use App\Events\BookedAppointmant;
use App\Http\Services\Email\EmailService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailToConsultAppointment implements ShouldQueue
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
            'title' => ' وقت مشاوره'.$event->client->fullname, 
            'body' => " وقت مشاوره  ".$event->detail->nameWeek.' ساعت'.Carbon::parse($event->detail->start_time)->format('H:i'),
        ];

        $messageServiceSample->setTo($event->consultant->email);
        $messageServiceSample->setFrom('dokhtarooone@zaaaanooone.ir','test-project');
        $messageServiceSample->setDetails($details);
        $messageServiceSample->setSubject('کد احراز هویت شما');


        $messageServiceSample->fire();
    }
}
