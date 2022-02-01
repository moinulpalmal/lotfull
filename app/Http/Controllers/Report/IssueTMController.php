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

class IssueTMController extends Controller
{
    public function issueForm(){
        $receive_froms = ReceiveVM::getReceiveFromForSelectField();
        $issued_tos = IssueVM::getIssuedTosForSelectField();

        //return $issued_tos;
        $buyers = Buyer::allBuyersForSelectField();
        $garments_types = GarmentsType::allGarmentsTypesForSelectField();
        //return Auth::id();
        $locations = Location::allLocationsForSelectField();
       /* if(Auth::user()->hasTaskPermission('top-management', Auth::id())){

        }
        else if(Auth::user()->hasTaskPermission('management', Auth::id())){
            $locations = Location::allLocationsForSelectField();
        }
        else if(Auth::user()->hasTaskPermission('location', Auth::id())){
            $locations = Location::allLocationsForSelectFieldByUser(Auth::id());
        }
        else{
            $locations = Location::allLocationsForSelectField();
        }*/

        return view('report.issue.top-management.form', compact('receive_froms', 'buyers',
            'garments_types', 'locations', 'issued_tos'));
    }

    public function issueFormResult(Request $request){
       // return $request->all();
        /*$receive_from_date = $request->receive_from_date;
        $receive_to_date = $request->receive_to_date;
        $qc_from_date = $request->qc_from_date;
        $qc_to_date = $request->qc_tp_date;*/
        $report_data = IssueVM::issueReport($request, false);
       /* if(Auth::user()->hasTaskPermission('top-management', Auth::id())){

        }
        else if(Auth::user()->hasTaskPermission('management', Auth::id())){
            $report_data = IssueVM::issueReport($request, false);
        }
        else if(Auth::user()->hasTaskPermission('location', Auth::id())){
            $report_data = IssueVM::issueReport($request, true);
        }
        else{
            $report_data = IssueVM::issueReport($request, false);
        }*/

        //return $report_data;
        $total_issued_quantity = IssueVM::returnTotalIssued($report_data);
        return view('report.issue.top-management.report', compact('request', 'report_data', 'total_issued_quantity'));
    }
}
