<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Article;

class Autor extends Model
{
    use HasFactory;

    public function articles(){
        return $this->belongsToMany(Article::class)->withTimestamps();
    }

    public function apiObj(){
        return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'email'               => $this->email,
            'mebership'           => $this->mebership,
            'is_contact'          => $this->is_contact,
            'temporal_identifier' => $this->temporal_identifier,
            'created_at'          => (! empty($this->created_at)) ? $this->created_at->toDateTimeString() : '',
            'updated_at'          => (! empty($this->updated_at)) ? $this->updated_at->toDateTimeString() : '',
        ];
    }
}
