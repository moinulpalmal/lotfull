<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Imports\BuyerImports;
use App\Model\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class VendorController extends Controller
{
    public function index(){
        return view('settings.vendor');
    }

   /* private function oldData(){
// for old data
        //return $req->all();
        $collection = Excel::toArray(new BuyerImports(), 'upload/Vendor.xlsx');
        //return $collection;
        //return count($collection[0]);
        for($i = 0; $i < count($collection[0]); $i++ ){
            //return $i++;
            $country = $collection[0][$i];
            //return $country;
            $newBuyer = new Vendor();
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
        $data = DB::table('buyers')
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
            return Vendor::updateVendor($request);
        }
        else{
            return Vendor::insertVendor($request);
        }
    }

    public function edit(Request $request){
        return Vendor::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return Vendor::returnDelete($request->id);
    }

    public function activate(Request $request){
        return Vendor::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return Vendor::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = Vendor::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }
}
