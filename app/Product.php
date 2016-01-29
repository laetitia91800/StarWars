<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $dates = ['published_at'];
   protected $fillable = ['name','price','quantity','category_id','slug','published_at','status','abstract','content'];

   public function category() {
       return $this->belongsTo('App\Category');
   }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function picture(){
        return $this->hasOne('App\Picture');
    }

    public function history(){
        return $this->hasMany('App\history');
    }

    public function getNameAttribute($value){
        return ucfirst($value);//oblige la premiere lettre en majuscule

    }

    public function hasTag($tagId){
        foreach($this->tags as $tag) {
            if($tag->id==$tagId) return true;
        }
        return false;
    }


    public function scopeOnline($query){
        return $query->where('status','=','opened');
    }


    public function getPublishedatAttribute($value) {
       return Carbon::createFromFormat('Y-m-d H:i:s',$value)->format('d-m-Y');
    }

    public function setPublishedatAttribute($value){

        $this->attributes['Published_at'] = Carbon::createFromFormat('d-m-Y',$value)->format('Y-m-d H:i:s');


       //Carbon::createFromFormat dit : recupere le format envoye et transforme le au format attendu
        // ne pas oublier de rajouter use carbon en haut
    }
}
