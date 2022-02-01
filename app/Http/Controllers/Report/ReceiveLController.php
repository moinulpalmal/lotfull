<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\GarmentsType;
use App\Model\Location;
use App\View_Model\ReceiveVM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiveLController extends Controller
{
    public function receiveForm(){
        $receive_froms = ReceiveVM::getReceiveFromForSelectField();

        //return $receive_froms;
        $buyers = Buyer::allBuyersForSelectField();
        $garments_types = GarmentsType::allGarmentsTypesForSelectField();
        //return Auth::id();
        $locations = Location::allLocationsForSelectFieldByUser(Auth::id());


        return view('report.receive.location.form', compact('receive_froms', 'buyers',
            'garments_types', 'locations'));
    }

    public function receiveFormResult(Request $request){
        $report_data = ReceiveVM::receiveReport($request, true);
        $total_received_quantity = ReceiveVM::returnTotalReceived($report_data);
        return view('report.receive.location.report', compact('request', 'report_data', 'total_received_quantity'));
    }
}
