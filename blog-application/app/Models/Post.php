<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $directory = 'images';
    use HasFactory; 
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getPostImageAttribute($value){
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('images/posts/' . $value);
    }
}
