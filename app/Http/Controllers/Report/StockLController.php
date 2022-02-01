<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\GarmentsType;
use App\Model\Location;
use App\View_Model\ReceiveVM;
use App\View_Model\StockVM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockLController extends Controller
{
    public function stockForm(){
        $receive_froms = ReceiveVM::getReceiveFromForSelectField();

        // return $receive_froms;
        $buyers = Buyer::allBuyersForSelectField();
        $garments_types = GarmentsType::allGarmentsTypesForSelectField();
        $locations = Location::allLocationsForSelectFieldByUser(Auth::id());

        return view('report.stock.location.form', compact('receive_froms', 'buyers',
            'garments_types', 'locations'));
    }

    public function stockFormResult(Request $request){
        $report_data = StockVM::stockReport($request, true);
        //return $report_data;
        $total_received_quantity = StockVM::returnTotalReceived($report_data);
        $total_issued_quantity = StockVM::returnTotalIssued($report_data);

        return view('report.stock.location.report', compact('request', 'report_data',
            'total_received_quantity', 'total_issued_quantity'));
    }
}
