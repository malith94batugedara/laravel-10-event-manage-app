<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
         'title',
         'slug',
         'description',
         'start_date',
         'end_date',
         'start_time',
         'image',
         'address',
         'num_tickets',
         'user_id',
         'country_id',
         'city_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city():BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes():HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function bookings():HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function tags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tag){
        return $this->tags->contains($tag);
    }
}
