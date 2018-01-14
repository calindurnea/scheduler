<?php

namespace App\Mail;

use App\Shift;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MonthlyShifts extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user, $shifts )
    {
        $this->user = $user;
        $this->shifts = $shifts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('scheduler@shifts.com')
            ->view('mail.monthlyShifts')
            ->with(['shifts' => $this->shifts]);
    }
}
