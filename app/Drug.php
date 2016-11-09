<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $table = 'drug';

    public function brand(){
        return $this->hasOne('App\Brand','id','brand_id');
    }

    protected $casts = [
        'brand_id' => 'string'
    ];
}
