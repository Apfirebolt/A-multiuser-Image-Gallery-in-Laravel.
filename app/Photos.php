<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $fillable = array('album_id', 'description', 'photo', 'title', 'size');

    //Creating foreign key relationship
    public function album() {
        return $this->belongsTo('App/Album');
    }
}
