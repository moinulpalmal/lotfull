<?php

namespace App\Http\Controllers\Settings\Api;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function allNotDeletedBuyers(){
        return Buyer::allNotDeleteBuyers();
    }
}
