<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
        return $this->belongsTo('User');
    }

    public function cards(): hasmany
    {
        return $this->hasMany('Card');
    }
}
