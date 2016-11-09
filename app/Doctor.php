<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctor';

    public function emp(){
        return $this->hasOne('App\Employee','id','emp_id');
    }
}
