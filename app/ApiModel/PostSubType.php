<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class PostSubType extends Model
{
    protected $table ='app_post_subType';



    /**
     * One to many relationship with PostType
     * PostSubType belongsTo PostType
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postType()
    {
        return $this->belongsTo('App\ApiModel\PostType','post_type_id','id');
    }

}
