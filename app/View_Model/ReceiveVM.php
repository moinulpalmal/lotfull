<?php

namespace App\View_Model;

use App\Model\Location;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceiveVM extends Model
{
    public static function getReceiveFromForSelectField(){
        return DB::table('receive_froms')
            ->select('id', 'receive_from_name AS name')
            ->orderBy('receive_from_name')
            ->get();
    }

    public static function receiveListForImageUpload($request){
        $result = DB::table('view_receive_summary')
            ->orderBy('id')
            ->orderBy('receive_date', 'ASC')
            ->get();


        if (!empty($request->get('receive_date'))) {
            $result = $result->where('receive_date', $request->get('receive_date'));
        }
        if (!empty($request->get('reference_no'))) {
            $result = $result->where('reference_no', trim($request->get('reference_no')));
        }
        if (!empty($request->get('style_no'))) {
            $result = $result->where('style_no', trim($request->get('style_no')));
        }

        if (!empty($request->get('buyer'))) {
            $result = $result->where('buyer_id', $request->get('buyer'));
        }
        if (!empty($request->get('garments_type'))) {
            $result = $result->where('garments_type_id', $request->get('garments_type'));
        }
        if (!empty($request->get('receive_from'))) {
            $result = $result->where('receive_from_v', $request->get('receive_from'));
        }
        if (!empty($request->get('location'))) {
            $result = $result->where('location_id', $request->get('location'));
        }

        return $result;

    }
    public static function receiveReport($request, $location_active){

        $result = DB::table('view_receive_summary')
            ->orderBy('id')
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

        if (!empty($request->get('qc_from_date'))) {
            if(!empty($request->get('receive_to_date'))){
                $result = $result->whereBetween('qc_date',  array($request->qc_from_date, $request->qc_to_date));
            }else{
                $result = $result->whereBetween('qc_date',  array($request->qc_from_date, Carbon::now()->toDate()));
            }
        }

        if (!empty($request->get('receive_from'))) {
            $result = $result->whereIn('receive_from_v', $request->get('receive_from'));
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

    public static function getChallanListForSelect($receive_from, $location_id){
/*
        return DB::table('locations')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");*/
        //$locations = Location::getUserLocationIdArray(Auth::id());
        $result = DB::table('view_receive_summary')
                    ->select('id', 'reference_no AS name')
                    ->where('receive_master_status', 'I')
                    ->where('location_id', $location_id)
                    ->where('receive_from_v', $receive_from)
                    ->groupBy('id')
                    ->orderBy('reference_no', 'ASC')
                    ->pluck("id","name");

        return $result;
    }

    public static function getBuyerListByReceiveMaster($receive_master_id){
        $result = DB::table('view_receive_summary')
            ->select('buyer_id AS id', 'buyer_name AS name')
            ->where('receive_master_status', 'I')
            ->where('id', $receive_master_id)
            ->groupBy('buyer_id')
            ->orderBy('buyer_name')
            ->pluck("id","name");
    }

    public static function getBuyerStyleListByReceiveMasterBuyer($receive_master_id, $buyer_id){
        $result = DB::table('view_receive_summary')
            ->select('buyer_style_id AS id', 'style_no AS name')
            ->where('receive_master_status', 'I')
            ->where('id', $receive_master_id)
            ->where('buyer_id', $buyer_id)
            ->groupBy('buyer_style_id')
            ->orderBy('style_no')
            ->pluck("id","name");
    }

    public static function returnTotalReceived($data){
        $sum = 0;
        foreach ($data AS $item){
            $sum = $sum + (integer)$item->received_total_quantity;
        }

        return $sum;
    }
}
