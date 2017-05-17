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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emails, $codigo)
    {
        $this->emails = $emails;
        $this->codigo = $codigo;
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
                Mail::send('emails.invitacion', ['email' => $email, 'codigo' => $this->codigo], function($message) use ($email)
                {
                    $message->from('contacto@byond.com', 'Byond');
                    $message->to($email, 'Nuevo Usuario')->subject('Completa tu registro de Byond');
                });
            }
        }
    }
}
