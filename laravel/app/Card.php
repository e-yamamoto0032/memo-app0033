<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    protected $fillable =[
        'body',
        'order',
        'sheet_id',
        'task_id'

    ];

    public function sheet(): BelongsTo
    {
        return $this->belongsTo('Sheet');
    }

}
