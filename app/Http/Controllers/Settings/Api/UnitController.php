<?php

namespace App\Http\Controllers\Settings\Api;

use App\Http\Controllers\Controller;
use App\Model\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function allNotDeletedUnits(){
        return Unit::allNotDeleteUnits();
    }
}
