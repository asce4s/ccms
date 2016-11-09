<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugSale extends Model
{
    protected $table = 'drugsale';

    public function post()
    {
        return $this->belongsTo('App\Sale', 'saleid', 'id');
    }
}
