<?php

namespace App\Http\Controllers\Issue\API;

use App\Http\Controllers\Controller;
use App\Model\Location;
use App\Model\Stock;
use App\Model\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function currentStock($user_id){
        return Stock::getCurrentActiveStockListAPI($user_id);
    }

    public function inActiveStock($user_id){
        return Stock::getCurrentInActiveStockListAPI($user_id);
    }

    public function oldStock($count, $user_id){
        return Stock::getOldStockListAPI($user_id, $count);
    }
}
