<?php

namespace App\Jobs;

use App\QueuedEmail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected  $emails;
    protected $codigo;
    protected $view;
    protected $subject;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emails, $codigo, $view, $subject)
    {
        $this->emails = $emails;
        $this->codigo = $codigo;
        $this->view = $view;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach($this->emails as $email) {
            $usuario = User::where('email', $email)->get()->first();
            if(!isset($usuario)) {
                Mail::send($this->view, ['email' => $email, 'codigo' => $this->codigo], function($message) use ($email)
                {
                    $message->from('contacto@byond.com', 'Byond');
                    $message->to($email, 'Usuario')->subject($this->subject);
                });
            }
        }
    }
}
