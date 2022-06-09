<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relacion Uno a Muchos inversa

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Relacion Muchos a muchos

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //uno a uno polimorfica

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    //

    public function users(){
        return $this->hasMany(User::class);
    }

    public function favorites(){
        return $this->belongsToMany(User::class);
    }
}
