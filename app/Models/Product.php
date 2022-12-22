<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes, Trans;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }
}
