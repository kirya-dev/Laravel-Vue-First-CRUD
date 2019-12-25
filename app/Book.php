<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'production_year', 'price', 'description'];


    public function authors()
    {
        return $this->belongsToMany('App\Author')->using('App\BookAuthor')->withPivot('author_type_id');
    }
}
