<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sheet extends Model
{
    protected $fillable =[
        'title',
        'body',
        'deadline',
        'end_date',
        'status',
        'user_id'

    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
