<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table ='app_city';
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * One to many relationship with City
     * City belongsTo Country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\ApiModel\Country','country_id','id');
    }
}
