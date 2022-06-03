<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Subject extends Model
{
    use HasFactory;

    public function articles(){
        return $this->belongsToMany(Article::class)->withTimestamps();
    }


}
