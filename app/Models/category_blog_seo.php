<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_blog_seo extends Model
{
    use HasFactory;
    public $table = 'category_blog_seos';
    public $timestamps = false;
    protected $fillable = ['canonical','file','blogid'];

    public function blogcategory()
    {
        return $this->hasMany(BlogCategory::class);
    }
}
