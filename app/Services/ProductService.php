<?php

namespace App\Services;
use App\Models\Vehicle;
use App\Models\Model;

class ProductService {
  public function vehicleApi($request){
    return  Vehicle::where('maker_id', $request->maker)->where('name_en', 'LIKE', $request->initial.'%') ->get();
  }
  public function modelApi($request){
    return  Model::where('vehicle_id', $request->vehicle)->get();
  }
}