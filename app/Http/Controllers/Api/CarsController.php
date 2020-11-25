<?php

namespace App\Http\Controllers\Api;
use App\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::select('id','name','brand','color')
            ->get();
        return response()->json(['data'=>$cars], 200);
    }
  
    public function create(Request $request)
    {
       $cars =  Car::create([
            'name' => 'Mirage',
            'brand' => 'Toyota',
            'color' => 'white'
        ]);

    return response()->json(['message' => 'Car information created successfully']);
    }

    public function delete(Request $request,$id)
    {
        $cars = Car::find($id);
        $cars->delete();
        return response()->json(['message' => 'Car delete successfully']);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        $cars = Car::find($id);
        $cars->update($request->all());
        
        return response()->json($cars);
        // return response()->json(['message' => 'Car updated successfully']);
    }
}
