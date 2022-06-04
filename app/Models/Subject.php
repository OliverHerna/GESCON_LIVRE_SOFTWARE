<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\User;

class Subject extends Model
{
    use HasFactory;

    public function articles(){
        return $this->belongsToMany(Article::class)->withTimestamps();
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
