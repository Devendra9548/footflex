<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSeo extends Model
{
    use HasFactory;
    public $table = 'blog_seo';
    public $timestamps = false;
    protected $fillable = ['canonical','file','blogid'];

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }

}
