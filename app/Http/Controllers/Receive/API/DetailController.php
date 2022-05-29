<?php

namespace App\Http\Controllers\Receive\API;

use App\Http\Controllers\Controller;
use App\Model\ReceiveDetail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function listInserted($user_id){
        return ReceiveDetail::getInsertedListAPI($user_id);
    }

    public function listQCInserted($user_id){
        return ReceiveDetail::getQCInsertedListAPI($user_id);
    }

    public function listQCFinished($user_id){
        return ReceiveDetail::getQCFinishedListAPI($user_id);
    }
}
