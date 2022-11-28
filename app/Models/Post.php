<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];
    
    protected $with = ['category', 'user'];

    protected $fillable = ['title'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                            ->logOnly(['title']);
    }

    final public function category()
    {
        return $this->belongsTo(Category::class);
    }

    final public function user()
    {
        return $this->belongsTo(User::class);
    }

    final public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    final public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => 
            $query->where(fn($query) => 
                $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category) => 
            $query->whereHas('category', fn($query) => 
                $query->where('slug', $category)
            )
        );

        $query->when($filters['user'] ?? false, fn($query, $user) => 
            $query->whereHas('user', fn($query) => 
                $query->where('username', $user)
            )
        );
    }

    final public function slug(): Attribute
    {
        return Attribute::set(fn() => 
            Str::slug($this->attributes['title']) . '-' .uniqid()
        );
    }

    final public function excerpt(): Attribute
    {
        return Attribute::set(fn() => 
            Str::words($this->attributes['body'] ?? fake()->paragraph(), 20)
        );
    }

    final public function userId(): Attribute
    {
        return Attribute::set(fn() =>
            auth()->id() ?? User::factory()->create()->id
        );
    }
}
