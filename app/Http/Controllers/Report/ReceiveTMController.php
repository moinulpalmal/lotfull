<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\GarmentsType;
use App\Model\Location;
use App\View_Model\ReceiveVM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiveTMController extends Controller
{
    public function receiveForm(){
        $receive_froms = ReceiveVM::getReceiveFromForSelectField();

        //return $receive_froms;
        $buyers = Buyer::allBuyersForSelectField();
        $garments_types = GarmentsType::allGarmentsTypesForSelectField();
        //return Auth::id();
        if(Auth::user()->hasTaskPermission('top-management', Auth::id())){
            $locations = Location::allLocationsForSelectField();
        }
        else if(Auth::user()->hasTaskPermission('management', Auth::id())){
            $locations = Location::allLocationsForSelectField();
        }
        else if(Auth::user()->hasTaskPermission('location', Auth::id())){
            $locations = Location::allLocationsForSelectFieldByUser(Auth::id());
        }
        else{
            $locations = Location::allLocationsForSelectField();
        }

        return view('report.receive.top-management.form', compact('receive_froms', 'buyers',
        'garments_types', 'locations'));
    }

    public function receiveFormResult(Request $request){
        //return $request->all();
        /*$receive_from_date = $request->receive_from_date;
        $receive_to_date = $request->receive_to_date;
        $qc_from_date = $request->qc_from_date;
        $qc_to_date = $request->qc_tp_date;*/
        //if()
        $report_data = ReceiveVM::receiveReport($request, false);
        /*if(Auth::user()->hasTaskPermission('top-management', Auth::id())){
            $report_data = ReceiveVM::receiveReport($request, false);
        }
        else if(Auth::user()->hasTaskPermission('management', Auth::id())){
            $report_data = ReceiveVM::receiveReport($request, false);
        }
        else if(Auth::user()->hasTaskPermission('location', Auth::id())){
            $report_data = ReceiveVM::receiveReport($request, true);
        }
        else{
            $report_data = ReceiveVM::receiveReport($request, false);
        }*/
        $total_received_quantity = ReceiveVM::returnTotalReceived($report_data);
        return view('report.receive.top-management.report', compact('request', 'report_data', 'total_received_quantity'));
    }
}
