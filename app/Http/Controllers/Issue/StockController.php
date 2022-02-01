<?php

namespace App\Http\Controllers\Issue;

use App\Http\Controllers\Controller;
use App\Model\Location;
use App\Model\ReceiveImage;
use App\Model\Stock;
use App\Model\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function currentStock(){
        $locations = Location::allLocationsForSelectFieldByUser(Auth::id());
       // $locations;

        $vendors = Vendor::allVendorsForSelectField();
        $departments = Stock::getCurrentStockList();

        //return $departments;
        $issue_locations = Location::allLocationsForSelectField();
        //return $issue_locations;
      // return $departments;
        return view('issue.stock.current', compact('departments',
            'locations', 'vendors', 'issue_locations'));
    }

    public function stockPrintView($master_id, $detail_id){
        $stocks = Stock::stockDetail($master_id, $detail_id);
        $stock_images = ReceiveImage::getAllActiveImages($master_id, $detail_id);

        return view('issue.stock.single-print',
            compact('stocks', 'stock_images', 'master_id', 'detail_id'));
    }
    public function inActiveStock(){
        $departments = Stock::getInActiveStockList();
        // return $departments;
        return view('issue.stock.in-active', compact('departments'));
    }

    public function oldStock(){
        $departments = Stock::getClosedStockList(5000);
        // return $departments;
        return view('issue.stock.old', compact('departments'));
    }


    public function deleteStock(Request $request){
        return Stock::returnDelete(Stock::returnMasterIdFromComplexStr($request->id),
            Stock::returnDetailIdFromComplexStr($request->id));
    }

    public function activateStock(Request $request){
        return Stock::returnActivate(Stock::returnMasterIdFromComplexStr($request->id),
            Stock::returnDetailIdFromComplexStr($request->id));
    }

    public function deActivateStock(Request $request){
        return Stock::returnDeActivate(Stock::returnMasterIdFromComplexStr($request->id),
            Stock::returnDetailIdFromComplexStr($request->id));
    }
}
