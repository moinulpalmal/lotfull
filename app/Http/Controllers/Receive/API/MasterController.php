<?php

namespace App\Http\Controllers\Receive\API;

use App\Http\Controllers\Controller;
use App\Model\ReceiveMaster;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function listInserted($user_id){
        return ReceiveMaster::getAllNReceiveMasterListInsertedApi($user_id, 3000);
    }
}
