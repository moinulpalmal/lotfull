<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\Factory;
use App\Model\GarmentsType;
use App\Model\Location;
use App\Model\Unit;
use App\View_Model\ReceiveVM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiveController extends Controller
{
    public function receiveForm(){
        $receive_froms = ReceiveVM::getReceiveFromForSelectField();
        $buyers = Buyer::allBuyersForSelectField();
        $garments_types = GarmentsType::allGarmentsTypesForSelectField();
        //return Auth::id();
        $locations = Location::allLocationsForSelectField();
    }
}
