<?php

namespace App\Models;

use App\Models\PostImage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $guarded = ['id']; // For mass assignment variable

    // Belongs to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Get post images
    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id', 'id');
    }
}
