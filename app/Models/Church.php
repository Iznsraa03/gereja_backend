<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Church extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    //

    public function category() { return $this->belongsTo(ChurchCategory::class); }
    public function schedules() { return $this->hasMany(WorshipSchedule::class); }
    public function facilities() { return $this->belongsToMany(Facility::class); }
    public function images() { return $this->hasMany(ChurchImage::class); }
    public function scopeCloseTo($query, $lat, $lng) {
        $haversine = "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))";
        return $query->selectRaw("*, {$haversine} AS distance", [$lat, $lng, $lat])->orderBy('distance');
    }
}

