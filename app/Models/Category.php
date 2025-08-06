<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
     
    public $timestamps = false; // ✅ disables auto timestamping

    protected $fillable = [
        'cat_name',
        'cat_od',
        'cat_status',
    ];


      public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    

    
}
