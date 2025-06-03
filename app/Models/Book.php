<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $guarded = [];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
