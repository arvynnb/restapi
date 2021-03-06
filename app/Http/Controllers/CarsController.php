<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use Yajra\DataTables\DataTables;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/home');
    }

    public function getData()
    {
        $cars = Car::select('id','name','brand','color')
            ->orderBy('id', 'DESC')
            ->get();
        // return Datatables::of($cars)->make(true);
        // return response()->json(['data'=>$cars]);  
        return Datatables::of(Car::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'color' => 'required|string'
        ]);

        $cars =  Car::create($request->all());
        return response()->json(['status'=>'success','is_success' => true, 'message' => 'Car add successfully']);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'car_name_edit'   => 'required|string',
            'car_brand_edit'  => 'required|string',
            'car_color_edit'  => 'required|string',
        ]);
        
        $car = Car::where('id',$request->car_id)->first();
        if ($car) {
            $car->update([
                'name' => $validatedData['car_name_edit'],
                'brand' => $validatedData['car_brand_edit'],
                'color' => $validatedData['car_color_edit']
            ]);
            return response()->json(['status'=>'success','is_success' => true, 'message' => 'Car update successfully']);
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cars = Car::find($request->car_id_delete);
        $cars->delete();

        return response()->json(['status'=>'success','is_success' => true, 'message' => 'Car deleted successfully']);
    }

    public function deleteSelectedCars(Request $request)
    {
        if(!$request->ids){
            return response()->json(['status'=>'error','is_success' => false, 'message' => 'Please Select item']);
        }
        $cars = Car::whereIn('id',$request->ids);
        $cars->delete();
        return response()->json(['status'=>'success','is_success' => true, 'message' => 'Selected car deleted successfully']);
   
    }
}
