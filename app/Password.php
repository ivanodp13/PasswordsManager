<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $table ='passwords';
    protected $filliable = ['title', 'password', 'category'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
