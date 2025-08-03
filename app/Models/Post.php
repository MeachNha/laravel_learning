<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'img',
    ];


     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
   public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }


}
