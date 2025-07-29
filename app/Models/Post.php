<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    
    public $timestamps = false; // ✅ disables auto timestamping
    protected $fillable = [
        'title',
        'description',
        'published_at',
        'od',
        'status',
        'user_id',
        'category_id',
    ];


     public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
     public function tags(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }


}
