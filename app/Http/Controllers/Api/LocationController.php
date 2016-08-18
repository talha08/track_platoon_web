<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ApiModel\Country;
use App\ApiModel\City;

class LocationController extends Controller
{


        public function countryList(){

          return   $country = Country::lists('id','name');
         // return   $country = Country::all();

        }





        public function cityList($id){

        }





}
