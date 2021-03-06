<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\GarmentsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class GarmentsTypeController extends Controller
{
    public function index(){
       return view('settings.garments-type');
    }

  /*private function oldData(){
// for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/GarmentsType.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newBuyer = new GarmentsType();
            if($country[0] != "NAME"){
                if(!$this->isExist($country[0])){
                    //$newBuyer->id = $country[0];
                    $newBuyer->name = trim($country[0]);
                    $newBuyer->status = 'A';

                    $newBuyer->save();
                }
            }
            //return $country[0];
        };

        // $this->mapOldData();
    }

    private function isExist($value){
        $data = DB::table('garments_types')
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
            return GarmentsType::updateGarmentsType($request);
        }
        else{
            return GarmentsType::insertGarmentsType($request);
        }
    }

    public function edit(Request $request){
        return GarmentsType::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return GarmentsType::returnDelete($request->id);
    }

    public function activate(Request $request){
        return GarmentsType::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return GarmentsType::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = GarmentsType::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }
}
