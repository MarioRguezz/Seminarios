<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueuedEmail extends Model
{
    protected $table = "durango.queue_emails";
    protected $fillable = [
        'email',
        'enviado'
    ];

 }
