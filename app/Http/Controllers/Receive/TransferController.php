<?php

namespace App\Http\Controllers\Receive;

use App\Http\Controllers\Controller;
use App\Model\IssueDetail;
use App\Model\ReceiveDetail;
use App\Model\ReceiveMaster;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function transferInserted(){
        return view('receive.transfer.transfer-inserted');
    }

    public function transferAccepted(){
        $departments = IssueDetail::getActiveTransferredAcceptedList();

        return view('receive.transfer.transfer-approved', compact('departments'));
    }

    public function approveTransfer(Request $request){
        //update issue_detail
        //$issue_detail = IssueDetail::find($request->id);
        //return ReceiveDetail::returnBuyerStyleId($issue_detail->receive_master_id, $issue_detail->receive_detail_id);
        //return $issue_detail;
        if(IssueDetail::returnTransferComplete($request) == '1'){
            $issue_detail = IssueDetail::find($request->id);
           // return ReceiveDetail::insertSingleForTransfer(1, $issue_detail);
            if($issue_detail){
                $master_id = ReceiveMaster::insertTransferMaster($issue_detail);
                if($master_id > 0){
                   // return ReceiveDetail::insertSingleForTransfer($master_id, $issue_detail);
                    $result = ReceiveDetail::insertSingleForTransfer($master_id, $issue_detail);
                   if( $result == 'A'){
                       return ReceiveDetail::approveSingleQCInserted($master_id, 1);
                   }
                   else if($result == 'I'){
                       return true;
                   }
                   else if($result == '0'){
                       return '0';
                   }
                   else{
                       return '0';
                   }
                }
            }
        }
        return '0';
        //insert receive_master
        //insert receive_detail
        //insert QC
        //approve QC
    }
}
