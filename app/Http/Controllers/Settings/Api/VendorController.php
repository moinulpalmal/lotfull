<?php

namespace App\Http\Controllers\Settings\Api;

use App\Http\Controllers\Controller;
use App\Model\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function allNotDeletedVendors(){
        return Vendor::allNotDeleteVendors();
    }
}
