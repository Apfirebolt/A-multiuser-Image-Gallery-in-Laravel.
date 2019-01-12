<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = array('name', 'description', 'cover_image');

    // Creating relationship
    public function photos() {
        return $this->hasMany('App\Photos');
    }

    //Creating foreign key relationship
    public function user() {
        return $this->belongsTo('App\User');
    }
}
