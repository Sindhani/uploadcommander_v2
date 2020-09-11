<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ButtonStatistic extends Model
{
    protected $guarded = [];

    public function statistics()
    {
        return $this->belongsTo(Feed::class);
    }
}
