<?php

namespace Firefly\FilamentBlog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'fblog_posts'; // ✅ Set correct table name

    protected $fillable = [
        'title', 'slug', 'body', 'cover_photo_path', 'photo_alt_text',
        'user_id', 'status', 'published_at'
    ];

    /**
     * Relationship: Post belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
