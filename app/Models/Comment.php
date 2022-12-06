<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Comment extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                            ->logOnly(['body']);
    }

    final public function post()
    {
        return $this->belongsTo(Post::class);
    }

    final public function user()
    {
        return $this->belongsTo(User::class);
    }
}
