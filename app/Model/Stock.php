<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    public static function getCurrentStockList(){
        $locations = Location::getUserLocationIdArray(Auth::id());
        return DB::table('stocks')
            ->join('receive_details', function ($join) {
                $join->on('receive_details.counter', '=', 'stocks.receive_detail_id');
                $join->on('receive_details.receive_master_id', '=', 'stocks.receive_master_id');
            })
            ->join('receive_masters', 'receive_masters.id', '=', 'stocks.receive_master_id')
            ->join('locations', 'locations.id', '=', 'receive_masters.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id', 'receive_masters.receive_date',
                'locations.short_name AS location_short_name', 'stocks.receive_detail_id',
                'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'stocks.received_total_quantity', 'stocks.grade_a', 'stocks.grade_b',
                'stocks.grade_c', 'stocks.grade_d', 'stocks.grade_t',
                'stocks.issued_grade_a', 'stocks.issued_grade_b', 'stocks.issued_grade_c', 'stocks.issued_grade_d', 'stocks.issued_grade_t',
                'stocks.issued_total_quantity', 'stocks.status AS stock_status', 'stocks.location_id')
            ->where('stocks.status', '=', 'A')
            ->whereIn('stocks.location_id', $locations)
            ->orderBy('stocks.receive_date', 'ASC')
            ->orderBy('receive_masters.id', 'ASC')
            ->orderBy('receive_details.counter', 'ASC')
            ->get();
    }

    public static function stockDetail($master_id, $detail_id){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('view_current_stock_summary')
            ->select('*')
            ->where('status', '!=','D')
            ->where('receive_master_id', '=', $master_id)
            ->where('receive_detail_id', '=', $detail_id)
            ->whereIn('location_id', $locations)
            ->orderBy('receive_date', 'ASC')
            ->get();
/*
        return DB::table('stocks')
            ->join('receive_details', function ($join) {
                $join->on('receive_details.counter', '=', 'stocks.receive_detail_id');
                $join->on('receive_details.receive_master_id', '=', 'stocks.receive_master_id');
            })
            ->join('receive_masters', 'receive_masters.id', '=', 'stocks.receive_master_id')
            ->join('locations', 'locations.id', '=', 'receive_masters.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id', 'receive_masters.receive_date',
                'locations.short_name AS location_short_name', 'stocks.receive_detail_id',
                'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'stocks.received_total_quantity', 'stocks.grade_a', 'stocks.grade_b',
                'stocks.grade_c', 'stocks.grade_d',
                'stocks.issued_grade_a', 'stocks.issued_grade_b', 'stocks.issued_grade_c', 'stocks.issued_grade_d',
                'stocks.issued_total_quantity', 'stocks.status AS stock_status', 'stocks.location_id')
            ->where('stocks.status', '!=', 'D')
            ->whereIn('stocks.location_id', $locations)
            ->where('stocks.receive_master_id', '=', $master_id)
            ->where('stocks.receive_detail_id', '=', $detail_id)
            ->orderBy('stocks.receive_date', 'ASC')
            ->get();*/
    }

    public static function getInActiveStockList(){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('stocks')
            ->join('receive_details', function ($join) {
                $join->on('receive_details.counter', '=', 'stocks.receive_detail_id');
                $join->on('receive_details.receive_master_id', '=', 'stocks.receive_master_id');
            })
            ->join('receive_masters', 'receive_masters.id', '=', 'stocks.receive_master_id')
            ->join('locations', 'locations.id', '=', 'receive_masters.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id', 'receive_masters.receive_date',
                'locations.short_name AS location_short_name', 'stocks.receive_detail_id',
                'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'stocks.received_total_quantity', 'stocks.grade_a', 'stocks.grade_b',
                'stocks.grade_c', 'stocks.grade_d', 'stocks.grade_t',
                'stocks.issued_grade_a', 'stocks.issued_grade_b', 'stocks.issued_grade_c', 'stocks.issued_grade_d', 'stocks.issued_grade_t',
                'stocks.issued_total_quantity', 'stocks.status AS stock_status', 'stocks.location_id')
            ->where('stocks.status', '=', 'I')
            ->whereIn('stocks.location_id', $locations)
            ->orderBy('stocks.receive_date', 'ASC')
            ->orderBy('receive_masters.id', 'ASC')
            ->orderBy('receive_details.counter', 'ASC')
            ->get();
    }

    public static function getClosedStockList($count){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('stocks')
            ->join('receive_details', function ($join) {
                $join->on('receive_details.counter', '=', 'stocks.receive_detail_id');
                $join->on('receive_details.receive_master_id', '=', 'stocks.receive_master_id');
            })
            ->join('receive_masters', 'receive_masters.id', '=', 'stocks.receive_master_id')
            ->join('locations', 'locations.id', '=', 'receive_masters.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id', 'receive_masters.receive_date',
                'locations.short_name AS location_short_name', 'stocks.receive_detail_id',
                'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'stocks.received_total_quantity', 'stocks.grade_a', 'stocks.grade_b',
                'stocks.grade_c', 'stocks.grade_d', 'stocks.grade_t',
                'stocks.issued_grade_a', 'stocks.issued_grade_b', 'stocks.issued_grade_c', 'stocks.issued_grade_d', 'stocks.issued_grade_t',
                'stocks.issued_total_quantity', 'stocks.status AS stock_status', 'stocks.location_id')
            ->where('stocks.status', '=', 'C')
            ->whereIn('stocks.location_id', $locations)
            ->orderBy('stocks.receive_date', 'ASC')
            ->orderBy('receive_masters.id', 'ASC')
            ->orderBy('receive_details.counter', 'ASC')
            ->get()
            ->take($count);
    }

    public static function returnDelete($receive_master_id, $receive_detail_id){
        //$model = Buyer::find($id);

        $data = DB::table('stocks')
            ->where('receive_master_id', $receive_master_id)
            ->where('receive_detail_id', $receive_detail_id)
            ->update([
                'status' => 'D',
                'last_updated_by' => Auth::id(),
            ]);

        //update current stock

        return $data;
    }

    public static function returnActivate($receive_master_id, $receive_detail_id){
        //$model = Buyer::find($id);

        $data = DB::table('stocks')
            ->where('receive_master_id', $receive_master_id)
            ->where('receive_detail_id', $receive_detail_id)
            ->update([
                'status' => 'A',
                'last_updated_by' => Auth::id(),
            ]);

        return $data;
    }


    public static function returnDeActivate($receive_master_id, $receive_detail_id){
        //$model = Buyer::find($id);

        $data = DB::table('stocks')
            ->where('receive_master_id', $receive_master_id)
            ->where('receive_detail_id', $receive_detail_id)
            ->update([
                'status' => 'I',
                'last_updated_by' => Auth::id(),
            ]);

        return $data;
    }
    public static function singleIssue($request){
        $data = DB::table('stocks')
                ->select('issued_grade_a', 'issued_grade_b', 'issued_grade_c', 'issued_grade_d',
                    'issued_total_quantity', 'received_total_quantity')
                ->where('receive_master_id', $request->receive_master_id)
                ->where('receive_detail_id', $request->receive_detail_id)
                ->where('status', 'A')
                ->first();

        if($data){
            $current_total_issued = (integer)$request->grade_a + (integer)$request->grade_b + (integer)$request->grade_c + (integer)$request->grade_d;
            $updated_total_issued = (integer)$data->issued_total_quantity + $current_total_issued;
            if($updated_total_issued >= ((integer)$data->received_total_quantity)){
                $result = DB::table('stocks')
                    ->where('receive_master_id', $request->receive_master_id)
                    ->where('receive_detail_id', $request->receive_detail_id)
                    ->update([
                        'issued_grade_a' => ((integer)$data->issued_grade_a + (integer)$request->grade_a),
                        'issued_grade_b' => ((integer)$data->issued_grade_b + (integer)$request->grade_b),
                        'issued_grade_c' => ((integer)$data->issued_grade_c + (integer)$request->grade_c),
                        'issued_grade_d' => ((integer)$data->issued_grade_d + (integer)$request->grade_d),
                        'issued_total_quantity' => $updated_total_issued,
                        'status' => 'C',
                        'last_updated_by' => Auth::id(),
                    ]);

                return $result;
            }
            else{
                $result = DB::table('stocks')
                    ->where('receive_master_id', $request->receive_master_id)
                    ->where('receive_detail_id', $request->receive_detail_id)
                    ->update([
                        'issued_grade_a' => ((integer)$data->issued_grade_a + (integer)$request->grade_a),
                        'issued_grade_b' => ((integer)$data->issued_grade_b + (integer)$request->grade_b),
                        'issued_grade_c' => ((integer)$data->issued_grade_c + (integer)$request->grade_c),
                        'issued_grade_d' => ((integer)$data->issued_grade_d + (integer)$request->grade_d),
                        'issued_total_quantity' => $updated_total_issued,
                        'status' => 'A',
                        'last_updated_by' => Auth::id(),
                    ]);

                return $result;
            }
        }
        return false;
    }

    public static function updateStockWhenIssueDetailDeleted($request){
        $data = DB::table('stocks')
            ->select('issued_grade_a', 'issued_grade_b', 'issued_grade_c', 'issued_grade_d',
                'issued_total_quantity', 'received_total_quantity','status')
            ->where('receive_master_id', $request->receive_master_id)
            ->where('receive_detail_id', $request->receive_detail_id)
            ->where('status'  ,'!=', 'D')
            ->get();

        //return $data;

        if($data[0]->status == 'A'){
            $current_total_issued = (integer)$request->grade_a + (integer)$request->grade_b + (integer)$request->grade_c + (integer)$request->grade_d;
            $updated_total_issued = (integer)$data[0]->issued_total_quantity - $current_total_issued;
            if($updated_total_issued >= ((integer)$data[0]->received_total_quantity)){
                $result = DB::table('stocks')
                    ->where('receive_master_id', $request->receive_master_id)
                    ->where('receive_detail_id', $request->receive_detail_id)
                    ->update([
                        'issued_grade_a' => ((integer)$data[0]->issued_grade_a - (integer)$request->grade_a),
                        'issued_grade_b' => ((integer)$data[0]->issued_grade_b - (integer)$request->grade_b),
                        'issued_grade_c' => ((integer)$data[0]->issued_grade_c - (integer)$request->grade_c),
                        'issued_grade_d' => ((integer)$data[0]->issued_grade_d - (integer)$request->grade_d),
                        'issued_total_quantity' => $updated_total_issued,
                        'status' => 'C',
                        'last_updated_by' => Auth::id(),
                    ]);

                return $result;
            }
            else{
                $result = DB::table('stocks')
                    ->where('receive_master_id', $request->receive_master_id)
                    ->where('receive_detail_id', $request->receive_detail_id)
                    ->update([
                        'issued_grade_a' => ((integer)$data[0]->issued_grade_a - (integer)$request->grade_a),
                        'issued_grade_b' => ((integer)$data[0]->issued_grade_b - (integer)$request->grade_b),
                        'issued_grade_c' => ((integer)$data[0]->issued_grade_c - (integer)$request->grade_c),
                        'issued_grade_d' => ((integer)$data[0]->issued_grade_d - (integer)$request->grade_d),
                        'issued_total_quantity' => $updated_total_issued,
                        'status' => 'A',
                        'last_updated_by' => Auth::id(),
                    ]);
                return $result;
            }
        }
        else if($data[0]->status == 'C'){
            $current_total_issued = (integer)$request->grade_a + (integer)$request->grade_b + (integer)$request->grade_c + (integer)$request->grade_d;
            $updated_total_issued = (integer)$data[0]->issued_total_quantity - $current_total_issued;

            $result = DB::table('stocks')
                ->where('receive_master_id', $request->receive_master_id)
                ->where('receive_detail_id', $request->receive_detail_id)
                ->update([
                    'issued_grade_a' => ((integer)$data[0]->issued_grade_a - (integer)$request->grade_a),
                    'issued_grade_b' => ((integer)$data[0]->issued_grade_b - (integer)$request->grade_b),
                    'issued_grade_c' => ((integer)$data[0]->issued_grade_c - (integer)$request->grade_c),
                    'issued_grade_d' => ((integer)$data[0]->issued_grade_d - (integer)$request->grade_d),
                    'issued_total_quantity' => $updated_total_issued,
                    'status' => 'A',
                    'last_updated_by' => Auth::id(),
                ]);

            return $result;
        }
        else{
            return '0';
        }
    }

    public static function getStockUnit($receive_master_id, $receive_detail_id){
        $data = DB::table('stocks')
            ->select('unit_id')
            ->where('receive_master_id', $receive_master_id)
            ->where('receive_detail_id', $receive_detail_id)
            ->first();
        if($data){
            return $data->unit_id;
        }

        return 0;
    }

    public static function returnMasterIdFromComplexStr($data){
        $master_id = substr($data, 0, strpos($data, '-'));
        return $master_id;
    }

    public static function returnDetailIdFromComplexStr($data){
        $master_id = substr($data, (strpos($data, '-')+1));
        return $master_id;
    }
}
