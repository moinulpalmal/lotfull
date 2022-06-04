<?php

namespace App\Http\Controllers\Receive\API;

use App\Http\Controllers\Controller;
use App\Model\IssueDetail;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function transferInserted($user_id){
        return IssueDetail::getActiveTransferredForAcceptListAPI($user_id);
    }

    public function transferAccepted($count, $user_id){
        return IssueDetail::getActiveTransferredAcceptedListAPI($user_id, $count);
    }
}
