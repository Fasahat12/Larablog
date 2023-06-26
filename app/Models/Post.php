<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function reactions() {
        return $this->hasMany(Reaction::class);
    }
}
