<?php

namespace App\Mail;

use App\Truck;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TruckAccepted extends Mailable
{
    use Queueable, SerializesModels;

    protected $truck;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Truck $truck)
    {
        $this->truck = $truck;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.truck_accepted')->with([
            'foodtruck' => $this->truck->name
        ]);
    }
}
