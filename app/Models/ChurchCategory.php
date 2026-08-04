<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChurchCategory extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function churches() {
        return $this->hasMany(Church::class);
    }
}
