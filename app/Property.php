<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    public function comments()
    {
        return $this->hasMany(Comment::class, 'property_id');
    }

    public function styles()
    {
        return $this->hasMany(Style::class, 'property_id');
    }


}
