<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';

    public function doctor(){
        return $this->hasOne('App\Doctor','id','doc_id');
    }

    protected $casts = [
        'doc_id' => 'string',
       'weekday' => 'string'
    ];
}
