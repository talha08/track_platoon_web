<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ApiModel\Country;
use App\ApiModel\City;
use Mockery\CountValidator\Exception;
use Response;

class LocationController extends Controller
{


        /**
         * @return \Illuminate\Http\JsonResponse
         *
         * Get Method
         * @param none
         * return country json 200 or error 403
         */
        public function countryList(){


           try{
               $country = Country::all();

               return Response::json(['country' => $country], 200);
           }catch(Exception $ex){
               return Response::json(['error' => 'Something went wrong'], 403);
           }
        }





    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Get Method
     * @param country_id
     * return city json  200  or error 403
     */
        public function cityList(Request $request){

                try{
                    $country_id = $request->country_id;
                    $city = City::where('country_id',$country_id )->get();

                    return Response::json(['city' => $city], 200);
                }catch(Exception $ex){
                    return Response::json(['error' => 'Something went wrong'], 403);
                }
        }





}
