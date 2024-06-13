<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use HasFactory;
    protected $fillable=['title','slug','body','approved','user_id','category_id','view_count'];

    //image relation
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }

    // user author relation
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // categorie relation
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeSearch($query,$term)
    {
        $term="%$term%";
        $query->where(function($query) use ($term){
            $query->where('title','like',$term);
        });
    }
}
