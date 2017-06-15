<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueuedEmail extends Model
{
    protected $table = "byondb.queue_emails";
    protected $fillable = [
        'email',
        'enviado'
    ];

 }
