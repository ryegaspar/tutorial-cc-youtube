<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function getImage()
    {
        if (!$this->image_filename) {
            return config('codetube.buckets.image') . '/profile/default.png';
        }

        return config('codetube.buckets.image') . '/profile/' .$this->image_filename;
    }
}
