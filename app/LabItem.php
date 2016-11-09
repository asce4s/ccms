<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabItem extends Model
{
    protected $table = 'labitems';


    public function brand(){
        return $this->hasOne('App\Brand','id','brand_id');
    }

    protected $casts = [
        'brand_id' => 'string'
    ];
}
