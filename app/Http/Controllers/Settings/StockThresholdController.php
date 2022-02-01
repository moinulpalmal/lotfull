<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Model\StockThreshold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StockThresholdController extends Controller
{
    public function index(){
        //$this->oldData();
        $departments = StockThreshold::allNotDeleteStockThresholds();
        return view('settings.stock-threshold', compact('departments'));
    }

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return StockThreshold::updateStockThreshold($request);
        }
        else{
            return StockThreshold::insertStockThreshold($request);
        }
    }

    public function edit(Request $request){
        return StockThreshold::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return StockThreshold::returnDelete($request->id);
    }

    public function activate(Request $request){
        return StockThreshold::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return StockThreshold::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = StockThreshold::getDropDownList();
            return json_encode($DropDownData);
        }

        return null;
    }
}
