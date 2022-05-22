<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Model\BuyerStyle;
use Illuminate\Http\Request;

class BuyerStyleController extends Controller
{
    public function index(){
        return view('settings.buyer-style');
    }

    public function save(Request $request){
        //return $request->all();
        if($request->id != null){
            return BuyerStyle::updateBuyerStyle($request);
        }
        else{
            return BuyerStyle::insertBuyerStyle($request);
        }
    }

    public function edit(Request $request){
        return BuyerStyle::returnForEdit($request->id);
    }

    public function delete(Request $request){
        return BuyerStyle::returnDelete($request->id);
    }

    public function activate(Request $request){
        return BuyerStyle::returnActivate($request->id);
    }

    public function deActivate(Request $request){
        return BuyerStyle::returnDeActivate($request->id);
    }

    public function getDropDownList(Request $request){
        if($request->check == 1){
            $DropDownData = BuyerStyle::getDropDownListByBuyer($request->buyer);
            return json_encode($DropDownData);
        }

        return null;
    }
}
