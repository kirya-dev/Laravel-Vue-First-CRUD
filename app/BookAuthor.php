<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookAuthor extends Pivot
{
    public function authorType()
    {
        return $this->belongsTo('App\AuthorType');
    }
}
