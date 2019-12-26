<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;

class Author extends Model
{
    use EagerLoadPivotTrait;


    protected $fillable = ['first_name', 'last_name'];
}
