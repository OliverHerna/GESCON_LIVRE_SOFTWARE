<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Session;
use App\Models\User;

class Event extends Model
{
    use HasFactory;

    public function sessions(){
        return $this->hasMany(Session::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
