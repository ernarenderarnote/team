<?php

namespace App\Modules\Admin\Controllers;

use App\State;
use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateAndCityController extends Controller
{
    /**
    * Get All state
    * @return state details
    * @Author Jitendra
    */
    public $data = [];
    public function getState(){
        $this->data["states"] = State::orderBy('id','desc')->get();
        return view('Admin::state.state-listing',$this->data);
    }
    /**
    * Add New State
    * @return state details
    * @Author Jitendra
    */
    public function addNewState(Request $request){
        if($request->isMethod('POST')){
            $this->validate($request,[
                'state_name' => 'required',
                'state_short_name' => 'required'
            ]);
            $state = new State;
            $state->name = $request->get('state_name');
            $state->short_name = $request->get('state_short_name');
            if($state->save()){
                return redirect('/admin/state');
            }else{
                Session::flash('flash_message', 'Opp! Please Try Again');
                return Redirect()->back();
            }
        }else{
            return view('Admin::state.add-state-form');
        }
    }
    /**
    * Get All City
    * @return City details
    * @Author Jitendra
    */
    public function getCity(){
        $this->data["cities"] = City::with('state')->orderBy('id','desc')->get();
        return view('Admin::city.city-listing',$this->data);
    }
    /**
    * Add New City
    * @return City details
    * @Author Jitendra
    */
    public function addNewCity(Request $request){
        if($request->isMethod('POST')){
            $this->validate($request,[
                'state' => 'required',
                'city_name' => 'required'
            ]);
            $city = new City;
            $city->state_id = $request->get('state');
            $city->name = $request->get('city_name');
            if($city->save()){
                return redirect('/admin/city');
            }else{
                Session::flash('flash_message', 'Opp! Please Try Again');
                return Redirect()->back();
            }
        }else{  
            $this->data["states"] = State::get();
            return view('Admin::city.add-city-form',$this->data);
        }
    }

}
