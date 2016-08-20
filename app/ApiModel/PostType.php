<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $table ='app_post_type';
    protected $hidden = ['created_at', 'updated_at'];


    /**
     * One to many relationship with PostSubType
     * PostType Has Many PostSubType
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postSubTypes(){
        return $this->hasMany('App\ApiModel\PostSubType','post_type_id','id');
    }

}
