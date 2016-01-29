<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    protected $fillable = ['product_id','customer_id','price','quantity','command_at'];

    public function customer() {

        return $this->belongsTo('App\Customer');
    }

    public function product() {

        return $this->belongsTo('App\Product');
    }

    public function ligneTotal() {

        $total = $this->price * $this->quantity;
        return number_format($total,2,',',' ');
    }

    public function getCommandatAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s',$value)->format('d-m-Y H:i:s');
    }



}
