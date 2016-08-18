<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;
    protected $table ='app_country';



    /**
     * One to many relationship with City
     * Country Has Many City
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities(){
        return $this->hasMany('App\ApiModel\City','country_id','id');
    }


}
