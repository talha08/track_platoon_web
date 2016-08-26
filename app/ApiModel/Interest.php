<?php

namespace App\ApiModel;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
  protected $table ='app_interest';


  //postSubType table
  public function postSubType(){
    return $this->belongsTo('App\ApiModel\PostSubType','app_subType_id','id');
  }

  //User table
  public function user(){
    return $this->belongsTo('App\ApiModel\AppUser','app_user_id','id');
  }


}
