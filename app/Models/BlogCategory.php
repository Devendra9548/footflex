<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    public $table = 'blogs_categories';
    public $timestamps = false;
    public function category_blog_seo()
    {
        return $this->hasMany(category_blog_seo::class);
    }
}
