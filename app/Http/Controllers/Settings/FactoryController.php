<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FactoryController extends Controller
{
    public function index(){
        //$this->oldData();
        $factories = Factory::allNotDeleteFactories();
        return view('settings.factory', compact('factories'));
    }

    private function oldData(){
// for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/Factory.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $model = new Factory();
            if($country[0] != "NAME"){
                if(!$this->isExist($country[0])){
                    //$newBuyer->id = $country[0];
                   // $model->name = trim($country[0]);
                    $model->factory_name =  trim($country[0]);
                    //$model->factory_short_name =  trim($country[1]);
                    $model->unit_name =  trim($country[1]);
                    $model->unit_short_name =  trim($country[1]);
                    $model->department_applicable = false;
                    $model->status = 'A';

                    $model->save();
                }
            }
            //return $country[0];
        };

        // $this->mapOldData();
    }

    private function isExist($value){
        /*$data = DB::table('garments_types')
            ->select('id')
            ->where('name', (string)$value)
            ->get();

        if($data->count() > 0){
            return true;
        }*/
       return false;
    }

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return Factory::updateFactory($request);
        }
        else{
            return Factory::insertFactory($request);
        }
    }

    public function edit(Request $request){
        return Factory::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return Factory::returnDelete($request->id);
    }

    public function activate(Request $request){
        return Factory::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return Factory::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = Factory::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }

}
