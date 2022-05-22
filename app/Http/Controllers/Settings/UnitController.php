<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UnitController extends Controller
{
    public function index(){
        return view('settings.unit');
    }
/*
    private function oldData(){
// for old data
        //return $req->all();
        $collection = Excel::toArray(new UnitImports(), 'upload/emp_hod.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newUnit = new Unit();
            if($country[0] != "EmployeeID"){
                if(!$this->isExist($country[4])){
                    //$newUnit->id = $country[0];
                    $newUnit->name = $country[4];
                    $newUnit->status = 'A';

                    $newUnit->save();
                }
            }
            //return $country[0];
        };

        // $this->mapOldData();
    }

    private function isExist($value){
        $data = DB::table('Units')
            ->select('id')
            ->where('name', (string)$value)
            ->get();

        if($data->count() > 0){
            return true;
        }
        return false;
    }*/

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return Unit::updateUnit($request);
        }
        else{
            return Unit::insertUnit($request);
        }
    }

    public function edit(Request $request){
        return Unit::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return Unit::returnDelete($request->id);
    }

    public function activate(Request $request){
        return Unit::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return Unit::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = Unit::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }
}
