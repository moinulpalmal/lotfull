<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IssueDetail extends Model
{
    public static function returnInsertDetail($request){
        $issue_detail = new IssueDetail();

        $issue_detail->receive_master_id = $request->receive_master_id;
        $issue_detail->receive_detail_id = $request->receive_detail_id;
        $issue_detail->reference_no = $request->reference_no;
        $issue_detail->issue_date = $request->issue_date;
        $issue_detail->issue_type = $request->issue_type;
        $issue_detail->is_issue_accepted = false;
        $issue_detail->issued_to = $request->issued_to;
        $issue_detail->location_id = $request->location_id;
        $issue_detail->unit_id = Stock::getStockUnit($request->receive_master_id, $request->receive_detail_id);

        $issue_detail->grade_a = $request->grade_a;
        $issue_detail->grade_b = $request->grade_b;
        $issue_detail->grade_c = $request->grade_c;
        $issue_detail->grade_d = $request->grade_d;
        $issue_detail->grade_t = $request->grade_t;



        $issue_detail->issued_total_quantity = (integer)$issue_detail->grade_a + (integer)$issue_detail->grade_b + (integer)$issue_detail->grade_c + (integer)$issue_detail->grade_d + (integer)$issue_detail->grade_t;
        $issue_detail->remarks = $request->remarks;
        $issue_detail->inserted_by = Auth::id();

        if($issue_detail->save()){
            return $issue_detail->id;
        }

        return 0;
    }

    public static function returnDelete($request){
        $issue_detail = IssueDetail::find($request->id);
        if($issue_detail){
            $issue_detail->status = 'D';
            $issue_detail->last_updated_by = Auth::id();
            if($issue_detail->save()){

                return '1';
            }

            return '0';
        }

        return '0';
    }

    public static function returnTransferComplete($request){
        $issue_detail = IssueDetail::find($request->id);
        if($issue_detail){
            $issue_detail->is_issue_accepted = true;
            $issue_detail->last_updated_by = Auth::id();
            if($issue_detail->save()){
                return '1';
            }

            return '0';
        }

        return '0';
    }

    public static function returnUpdate($request){

    }

    public static function getActiveIssuedList(){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('issue_details')
            ->join('stocks', function ($join) {
                $join->on('stocks.receive_detail_id', '=', 'issue_details.receive_detail_id');
                $join->on('stocks.receive_master_id', '=', 'issue_details.receive_master_id');
            })
            ->join('receive_details', function ($join) {
                $join->on('receive_details.counter', '=', 'stocks.receive_detail_id');
                $join->on('receive_details.receive_master_id', '=', 'stocks.receive_master_id');
            })
            ->join('receive_masters', 'receive_masters.id', '=', 'stocks.receive_master_id')
            ->join('locations', 'locations.id', '=', 'issue_details.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id',
                'locations.short_name AS location_short_name',
                'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'issue_details.reference_no',  'issue_details.issue_date', 'issue_details.issue_type',
                'issue_details.issued_to', 'issue_details.remarks', 'issue_details.is_issue_accepted',
                'issue_details.grade_a', 'issue_details.grade_b',
                'issue_details.grade_c', 'issue_details.grade_d', 'issue_details.grade_t', 'issue_details.id',
                'issue_details.issued_total_quantity', 'issue_details.status AS issue_status', 'issue_details.location_id')
            ->where('issue_details.status', '!=', 'D')
            ->where('issue_details.issue_type', '=', 'v')
            ->whereIn('issue_details.location_id', $locations)
            ->orderBy('issue_details.issue_date', 'DESC')
            ->get();
    }

    public static function getActiveTransferredList(){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('issue_details')
            ->join('stocks', function ($join) {
                $join->on('stocks.receive_detail_id', '=', 'issue_details.receive_detail_id');
                $join->on('stocks.receive_master_id', '=', 'issue_details.receive_master_id');
            })
            ->join('receive_details', function ($join) {
                $join->on('receive_details.counter', '=', 'stocks.receive_detail_id');
                $join->on('receive_details.receive_master_id', '=', 'stocks.receive_master_id');
            })
            ->join('receive_masters', 'receive_masters.id', '=', 'stocks.receive_master_id')
            ->join('locations', 'locations.id', '=', 'issue_details.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id',
                'locations.short_name AS location_short_name',
                'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'issue_details.reference_no',  'issue_details.issue_date', 'issue_details.issue_type',
                'issue_details.issued_to', 'issue_details.remarks',
                'issue_details.grade_a', 'issue_details.grade_b', 'issue_details.id',
                'issue_details.grade_c', 'issue_details.grade_d', 'issue_details.grade_t','issue_details.is_issue_accepted',
                'issue_details.issued_total_quantity', 'issue_details.status AS issue_status', 'issue_details.location_id')
            ->where('issue_details.status', '!=', 'D')
            ->where('issue_details.issue_type', '=', 't')
            ->whereIn('issue_details.location_id', $locations)
            ->orderBy('issue_details.issue_date', 'DESC')
            ->get();
    }

    public static function getActiveTransferredForAcceptList(){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('issue_details')
            ->join('stocks', function ($join) {
                $join->on('stocks.receive_detail_id', '=', 'issue_details.receive_detail_id');
                $join->on('stocks.receive_master_id', '=', 'issue_details.receive_master_id');
            })
            ->join('receive_details', function ($join) {
                $join->on('receive_details.counter', '=', 'stocks.receive_detail_id');
                $join->on('receive_details.receive_master_id', '=', 'stocks.receive_master_id');
            })
            ->join('receive_masters', 'receive_masters.id', '=', 'stocks.receive_master_id')
            ->join('locations', 'locations.id', '=', 'issue_details.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id', 'receive_details.counter',
                'locations.short_name AS location_short_name',
                'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'issue_details.reference_no',  'issue_details.issue_date', 'issue_details.issue_type',
                'issue_details.issued_to', 'issue_details.remarks',
                'issue_details.grade_a', 'issue_details.grade_b', 'issue_details.id',
                'issue_details.grade_c', 'issue_details.grade_d','issue_details.grade_t', 'issue_details.is_issue_accepted',
                'issue_details.issued_total_quantity', 'issue_details.status AS issue_status', 'issue_details.location_id')
            ->where('issue_details.status', '!=', 'D')
            ->where('issue_details.issue_type', '=', 't')
            ->where('issue_details.is_issue_accepted', '=', false)
            ->whereIn('issue_details.issued_to', $locations)
            ->orderBy('issue_details.issue_date', 'DESC')
            ->get();
    }

    public static function getActiveTransferredAcceptedList(){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('issue_details')
            ->join('stocks', function ($join) {
                $join->on('stocks.receive_detail_id', '=', 'issue_details.receive_detail_id');
                $join->on('stocks.receive_master_id', '=', 'issue_details.receive_master_id');
            })
            ->join('receive_details', function ($join) {
                $join->on('receive_details.counter', '=', 'stocks.receive_detail_id');
                $join->on('receive_details.receive_master_id', '=', 'stocks.receive_master_id');
            })
            ->join('receive_masters', 'receive_masters.id', '=', 'stocks.receive_master_id')
            ->join('locations', 'locations.id', '=', 'issue_details.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id',
                'locations.short_name AS location_short_name',
                'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'issue_details.reference_no',  'issue_details.issue_date', 'issue_details.issue_type',
                'issue_details.issued_to', 'issue_details.remarks',
                'issue_details.grade_a', 'issue_details.grade_b', 'issue_details.id',
                'issue_details.grade_c', 'issue_details.grade_d', 'issue_details.grade_t', 'issue_details.is_issue_accepted',
                'issue_details.issued_total_quantity', 'issue_details.status AS issue_status', 'issue_details.location_id')
            ->where('issue_details.status', '!=', 'D')
            ->where('issue_details.issue_type', '=', 't')
            ->where('issue_details.is_issue_accepted', '=', true)
            ->whereIn('issue_details.issued_to', $locations)
            ->orderBy('issue_details.issue_date', 'DESC')
            ->get();
    }

    /*public static function getActiveTransferredAcceptedList(){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('issue_details')
            ->join('stocks', function ($join) {
                $join->on('stocks.receive_detail_id', '=', 'issue_details.receive_detail_id');
                $join->on('stocks.receive_master_id', '=', 'issue_details.receive_master_id');
            })
            ->join('receive_details', function ($join) {
                $join->on('receive_details.counter', '=', 'stocks.receive_detail_id');
                $join->on('receive_details.receive_master_id', '=', 'stocks.receive_master_id');
            })
            ->join('receive_masters', 'receive_masters.id', '=', 'stocks.receive_master_id')
            ->join('locations', 'locations.id', '=', 'issue_details.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id',
                'locations.short_name AS location_short_name',
                'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'issue_details.reference_no',  'issue_details.issue_date', 'issue_details.issue_type',
                'issue_details.issued_to', 'issue_details.remarks',
                'issue_details.grade_a', 'issue_details.grade_b', 'issue_details.id',
                'issue_details.grade_c', 'issue_details.grade_d', 'issue_details.is_issue_accepted',
                'issue_details.issued_total_quantity', 'issue_details.status AS issue_status', 'issue_details.location_id')
            ->where('issue_details.status', '=', 'TA')
            ->where('issue_details.issue_type', '=', 't')
            ->where('issue_details.is_issue_accepted', '=', true)
            ->whereIn('issue_details.issued_to', $locations)
            ->orderBy('issue_details.issue_date', 'DESC')
            ->get();
    }*/

}
