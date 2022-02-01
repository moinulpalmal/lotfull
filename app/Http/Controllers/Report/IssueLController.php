<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\GarmentsType;
use App\Model\Location;
use App\View_Model\IssueVM;
use App\View_Model\ReceiveVM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueLController extends Controller
{
    public function issueForm(){
        $receive_froms = ReceiveVM::getReceiveFromForSelectField();
        $issued_tos = IssueVM::getIssuedTosForSelectField();

        //return $issued_tos;
        $buyers = Buyer::allBuyersForSelectField();
        $garments_types = GarmentsType::allGarmentsTypesForSelectField();
        //return Auth::id();
       // $locations = Location::allLocationsForSelectField();
        $locations = Location::allLocationsForSelectFieldByUser(Auth::id());


        return view('report.issue.location.form', compact('receive_froms', 'buyers',
            'garments_types', 'locations', 'issued_tos'));
    }

    public function issueFormResult(Request $request){
        $report_data = IssueVM::issueReport($request, true);
       // $total_received_quantity = StockVM::returnTotalReceived($report_data);
        $total_issued_quantity = IssueVM::returnTotalIssued($report_data);
        return view('report.issue.location.report', compact('request', 'report_data', 'total_issued_quantity'));
    }
}
