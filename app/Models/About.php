<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory;
    
    use Sluggable;
    protected $fillable = ['title','content','slug',];

    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
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
