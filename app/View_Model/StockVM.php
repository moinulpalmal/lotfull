<?php

namespace App\View_Model;

use App\Model\Location;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockVM extends Model
{
    public static function stockReport($request, $location_active){
        $result = DB::table('view_total_stock_summary')
            ->select('*')
            ->orderBy('receive_date', 'ASC')
            ->get();

        if($location_active == true){
            $locations = Location::getUserLocationIdArray(Auth::id());
            $result = $result->whereIn('location_id', $locations);
            if (!empty($request->get('location'))) {
                $result = $result->whereIn('location_id', $request->get('location'));
            }
        }
        else{
            if (!empty($request->get('location'))) {
                $result = $result->whereIn('location_id', $request->get('location'));
            }
        }

        if (!empty($request->get('receive_from_date'))) {
            if(!empty($request->get('receive_to_date'))){
                $result = $result->whereBetween('receive_date',  array($request->receive_from_date, $request->receive_to_date));
            }else{
                $result = $result->whereBetween('receive_date',  array($request->receive_from_date, Carbon::now()->toDate()));
            }
        }

        if (!empty($request->get('receive_from'))) {
            $result = $result->whereIn('receive_from_id', $request->get('receive_from'));
        }
        if (!empty($request->get('buyer'))) {
            $result = $result->whereIn('buyer_id', $request->get('buyer'));
        }

        if (!empty($request->get('garments_type'))) {
            $result = $result->whereIn('garments_type_id', $request->get('garments_type'));
        }

        if (!empty($request->get('reference_no'))) {
            $result = $result->where('reference_no', '=',trim($request->get('reference_no')));
        }

        if (!empty($request->get('receive_detail_status'))) {
            $result = $result->whereIn('receive_detail_status', $request->get('receive_detail_status'));
        }

        return $result;
    }

    public static function returnTotalStockReceived($data){
        $sum = 0;
        foreach ($data AS $item){
            $sum = $sum + (integer)$item->received_total_quantity;
        }

        return $sum;
    }

    public static function returnTotalReceived($data){
        $sum = 0;
        foreach ($data AS $item){
            $sum = $sum + (integer)$item->received_quantity;
        }

        return $sum;
    }

    public static function returnTotalIssued($data){
        $sum = 0;
        foreach ($data AS $item){
            $sum = $sum + (integer)$item->issued_total_quantity;
        }

        return $sum;
    }
}
