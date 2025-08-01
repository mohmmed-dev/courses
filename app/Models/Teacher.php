<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "avatar",
        "channel_id"
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
