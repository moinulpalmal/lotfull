<?php

namespace App\Http\Controllers\Receive;

use App\Http\Controllers\Controller;
use App\Model\IssueDetail;
use App\Model\ReceiveDetail;
use App\Model\ReceiveMaster;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function listInserted(){
        return view('receive.detail.list-inserted');
    }

    public function listQCFinished(){
        return view('receive.detail.list-qc-finished');
    }

    public function listQCInserted(){
               return view('receive.detail.list-qc-inserted');
    }

    public function deleteDetail(Request $request){
        //return ReceiveDetail::returnMasterIdFromComplexStr($request->id);
       // return ReceiveDetail::returnDetailIdFromComplexStr($request->id);

        return ReceiveDetail::returnDelete(ReceiveDetail::returnMasterIdFromComplexStr($request->id),
                                            ReceiveDetail::returnDetailIdFromComplexStr($request->id));

    }

    public function insertQC(Request $request){
        //return ReceiveDetail::returnMasterIdFromComplexStr($request->receive_master_id);
        // return ReceiveDetail::returnDetailIdFromComplexStr($request->id);

        return ReceiveDetail::returnInsertQC($request);

    }

    public function editQC(Request $request){
       // return json_encode($request->all());
        return ReceiveDetail::editQC($request);
    }

    public function approveSingleQCInserted(Request $request){
        return ReceiveDetail::approveSingleQCInserted(ReceiveDetail::returnMasterIdFromComplexStr($request->id),
            ReceiveDetail::returnDetailIdFromComplexStr($request->id));
    }

    public function approveAllQCInserted(Request $request){
        if($request->id = 'A'){
            return ReceiveDetail::approveAllQCInserted();
        }
        else{
            return 0;
        }

    }
}
