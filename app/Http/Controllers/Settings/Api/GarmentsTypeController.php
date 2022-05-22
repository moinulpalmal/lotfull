<?php

namespace App\Http\Controllers\Settings\Api;

use App\Http\Controllers\Controller;
use App\Model\GarmentsType;
use Illuminate\Http\Request;

class GarmentsTypeController extends Controller
{
    public function allNotDeletedGarmentsTypes(){
        return GarmentsType::allNotDeleteGarmentsTypes();
    }
}
