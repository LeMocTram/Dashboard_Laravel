<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'category_id',
        'deleted',
    ];

    // Định nghĩa mối quan hệ với model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
