<?php

namespace App\Containers\Enterprise\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EnterprisesQuotaEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $enterprises;

    public function __construct($e)
    {
        $this->enterprises = $e;
    }

    public function build(): self
    {
        $subject = 'Превышена квота на сотрудников';
        
        return $this->subject($subject)
                    ->view('emails.enterprises-quota')
                    ->with([
                        'enterprises' => $this->enterprises,
                    ]);
    }

}
