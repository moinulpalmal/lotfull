<?php

namespace App\Http\Controllers\Settings\Api;

use App\Http\Controllers\Controller;
use App\Model\BuyerStyle;
use Illuminate\Http\Request;

class BuyerStyleController extends Controller
{
    public function allNotDeletedBuyerStyles(){
        return BuyerStyle::allNotDeleteBuyerStyles();
    }
}
