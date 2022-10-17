<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;

class CityController extends Controller
{
    public function view()
    {
      $cities = City::all();
      $count = 0;
      return view('viewCities',compact('cities','count'));

    }
    public function edit(City $city)
    {
        $tiers = ['TIER1','TIER2','TIER3','TIER4'];
        $states = State::all();
      return view('editCity',compact('city','tiers','states'));

    }

    public function create(Request $request)
    {
       $city = new City();
       $city->state_id = $request->state_id;
       $city->city = $request->city;
       $city->price = $request->price;
       $city->tier = $request->tier;
       $city->save();
       session()->flash('message','City has been created successfully');
       return back();
    }


    public function update(City $city,Request $request)
    {
       $city->state_id = $request->state_id;
       $city->city = $request->city;
       $city->price = $request->price;
       $city->tier = $request->tier;
       $city->save();
       session()->flash('message','City has been updated successfully');
       return redirect()->route('view.city');
    }

    public function destroy(City $city)
    {
     $city->delete();
     session()->flash('danger','City has been deleted successfully');

     return back();
    }

}
