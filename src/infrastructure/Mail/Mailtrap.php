<?php


namespace Dailymotion\infrastructure\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mailtrap extends Mailable
{
    use Queueable, SerializesModels;

    private array $data;

    /**
     * Mailtrap constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        return $this->from('contact@daily.com', 'Mailtrap')
            ->subject('Here is your verification  code')
            ->markdown('email.mail')
            ->with([
                'code' => $data['code']
            ]);
    }

}
