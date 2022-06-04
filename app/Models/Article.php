<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Autor;
use App\Models\Document;
use App\Models\User;

class Article extends Model
{
    use HasFactory;

    public function autors(){
        return $this->belongsToMany(Autor::class);
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class);
    }

    public function documents(){
        return $this->belongsToMany(Document::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

