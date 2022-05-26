<?php

namespace App\Http\Controllers\Receive;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\Factory;
use App\Model\GarmentsType;
use App\Model\Location;
use App\Model\ReceiveMaster;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    public function listInserted(){
        //return Location::getUserLocationIdArray(Auth::id());

        $factories = Factory::allFactoriesForSelectField();
        $locations = Location::allLocationsForSelectFieldByUser(Auth::id());
        $departments = ReceiveMaster::getAllNotDeletedReceiveMasterListInserted();
        //return ReceiveMaster::getAllNotDeletedReceiveMasterListInsertedApi(Auth::id(), 5000);
        //return $locations;

        return view('receive.master.list-inserted', compact('departments', 'factories',
            'locations'));

    }

    public function updateMaster(Request $request){
        return ReceiveMaster::returnUpdate($request);
    }

    public function deleteMaster(Request $request){
        return ReceiveMaster::returnDelete($request);
    }

    public function editMaster(Request $request){
        return ReceiveMaster::returnMasterForUpdate($request->id);
    }
}
