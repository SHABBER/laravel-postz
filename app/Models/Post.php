<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title' ,'user_id', 'body', 'post_image'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //Mutators
    public function setPostImageAttribute($value){
        $this->attributes['post_image'] = asset('images/'.$value);
    }

    //Accessors
    public function getPostImageAttribute($value){
        return $value;
    }

    
}
