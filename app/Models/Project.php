<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'title',
        'description',
        'goal',
        'collected',
        'type_project_id',
        'slug',
        
    ];

    public function typeProject()
    {
        return $this->belongsTo(TypeProject::class);
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


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
