<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    
    public $timestamps = false; // ✅ disables auto timestamping



    protected $fillable = [
        'tag_name',
        'tag_status',
    ];
    


    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
