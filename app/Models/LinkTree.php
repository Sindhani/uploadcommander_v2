<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LinkTree extends Model
{
    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute($value){
        return str_replace('upco.de/', '' , $value );
    }
    public function getBgColorAttribute($value){
        if(stripos($value, '.jpeg')){
            return "url(".asset('images'.'/'.$value).")";
        }
        return substr($value,0, strpos($value, 'repeat'));
    }
}
