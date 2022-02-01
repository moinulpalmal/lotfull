<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(){
        //$this->oldData();
        $departments = Location::allNotDeleteLocations();
        return view('admin.Location', compact('departments'));
    }

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return Location::updateLocation($request);
        }
        else{
            return Location::insertLocation($request);
        }
    }

    public function edit(Request $request){
        return Location::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return Location::returnDelete($request->id);
    }

    public function activate(Request $request){
        return Location::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return Location::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = Location::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }
}
