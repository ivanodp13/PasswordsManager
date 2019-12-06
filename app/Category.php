<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='categories';
    protected $filliable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function passwords()
    {
        return $this->hasMany(Password::class);
    }
}
