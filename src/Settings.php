<?php

namespace Silvanite\AgencmsSettings;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'section',
        'key',
        'value',
    ];
}
