<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['uri','size','title','type','product_id'];

    public function product() {
        return $this->belongsTo('App\Product');
    }
}
