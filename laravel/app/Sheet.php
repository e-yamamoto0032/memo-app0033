<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    protected $fillable =[
        'title',
        'body',
        'deadline',
        'end_date',
        'status',
        'user_id',

    ];
}
