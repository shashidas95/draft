<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['post_content', 'post_image', 'user_id',];
    protected $attributes = [
        'comments' => '0',
        'post_views' => '0',
        'likes' => '0',
        'unlikes' => '0',
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
