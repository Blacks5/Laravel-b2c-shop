<?php

namespace App\Listeners;

use App\Events\Register;
use App\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail
{
    public $mailer;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mailer = new UserMailer();
    }

    /**
     * Handle the event.
     *
     * @param  Register  $event
     * @return void
     */
    public function handle(Register $event)
    {
        $this->mailer->welcome($event->user);
    }
}
