<?php

namespace App\Mail;

use App\Truck;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TruckDenied extends Mailable
{
    use Queueable, SerializesModels;

    protected $truck, $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Truck $truck,$message)
    {
        $this->truck = $truck;
        $this->message = $message;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.truck_denied')->with([
            'foodtruck' => $this->truck->name,
            'date' => Carbon::createFromFormat('Y-m-d H:i:s', $this->truck->created_at)->format('d/m/Y H:i'),
            'guest_mess' => $this->message
        ]);
    }
}
