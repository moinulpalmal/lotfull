<?php

namespace App\Http\Controllers\Issue\API;

use App\Http\Controllers\Controller;
use App\Model\IssueDetail;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function issued($count, $user_id){
        return IssueDetail::getActiveIssuedListAPI($user_id, $count);
    }

    public function transferred($count, $user_id){
       return IssueDetail::getActiveTransferredListAPI($user_id, $count);
    }
}
