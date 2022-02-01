<?php

namespace App\View_Model;

use App\Model\Location;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IssueVM extends Model
{
    public static function getIssuedTosForSelectField(){
        return DB::table('issued_tos')
            ->select('id', 'issued_to_name AS name')
            ->orderBy('issued_to_name')
            ->get();
    }

    public static function issueReport($request, $location_active){
        $result = DB::table('view_issue_summary')
                    ->orderBy('id')
                    ->orderBy('issue_date', 'ASC')
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

        if (!empty($request->get('issue_from_date'))) {
            if(!empty($request->get('issue_to_date'))){
                $result = $result->whereBetween('issue_date',  array($request->issue_from_date, $request->issue_to_date));
            }else{
                $result = $result->whereBetween('issue_date',  array($request->issue_from_date, Carbon::now()->toDate()));
            }
        }

        if (!empty($request->get('receive_from'))) {
            $result = $result->whereIn('receive_from', $request->get('receive_from'));
        }

        if (!empty($request->get('issued_to'))) {

            $result = $result->whereIn('issued_to_v', $request->get('issued_to'));
            //return $result;
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


        return $result;
    }

    public static function returnTotalIssued($data){
        $sum = 0;
        foreach ($data AS $item){
            $sum = $sum + (integer)$item->issued_total_quantity;
        }

        return $sum;
    }
}
