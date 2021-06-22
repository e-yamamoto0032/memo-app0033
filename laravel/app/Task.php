<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Task extends Model
{
    protected $fillable =[
        'title',
        'order',
        'sheet_id'

    ];

    public function sheet(): BelongsTo
    {
        return $this->belongsTo('Sheet');
    }

    public function cards(): hasmany
    {
        return $this->hasMany('Card');
    }
}
