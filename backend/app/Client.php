<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
     ];
 
     public function projects()
     {
        return $this->hasMany('App\Client');
     }
 
}
