<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'method',
        'ip',
        'input',
        'response'
    ];

    /**
     * active timestamps
     * timestamp is used in transferencia_data for execution registred
     * @var bool
     */
    public $timestamps = true;
}
