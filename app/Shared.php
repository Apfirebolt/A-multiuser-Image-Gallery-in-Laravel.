<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shared extends Model
{
    protected $table = 'shared';

    // Creating relationship
    public function photos() {
        return $this->hasOne('App\Photos');
    }
}
