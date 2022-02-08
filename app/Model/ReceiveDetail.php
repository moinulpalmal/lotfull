<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceiveDetail extends Model
{
    public static function insertDetailBulk( $masterId, $request){
        if(!empty($request->get('buyer_id'))){
            $i = 1;
            foreach($request->get('buyer_id') as $key => $v){
                $receiveDetail = new ReceiveDetail();
                $receiveDetail->receive_master_id = $masterId;
                $receiveDetail->counter = $i;
                $receiveDetail->buyer_id = $request->buyer_id[$key];
                $receiveDetail->garments_type_id = $request->garments_type_id[$key];
                $receiveDetail->buyer_style_id = BuyerStyle::returnBuyerStyleIdWithInsert($request->buyer_id[$key], $request->buyer_style_no[$key]);
                $receiveDetail->unit_id = $request->unit_id[$key];
                $receiveDetail->received_total_quantity = $request->received_total_quantity[$key];
                $receiveDetail->status = 'I';
                $receiveDetail->remarks = $request->detail_remarks[$key];
                $receiveDetail->inserted_by = Auth::id();
                $receiveDetail->save();
                $i++;
            }
            return '1';
        }

        return '0';
    }

    public static function insertSingleForTransfer($masterId, $request){
        $buyer_id = ReceiveDetail::returnBuyerId($request->receive_master_id, $request->receive_detail_id);
        //return $request;
        $buyer_style_id = ReceiveDetail::returnBuyerStyleId($request->receive_master_id, $request->receive_detail_id);
        //return $buyer_style_id;

        $receiveDetail = new ReceiveDetail();
        $receiveDetail->receive_master_id = $masterId;
        $receiveDetail->counter = 1;
        $receiveDetail->buyer_id = $buyer_id;
        $receiveDetail->garments_type_id = ReceiveDetail::returnGarmentsTypeId($request->receive_master_id, $request->receive_detail_id);
        $receiveDetail->buyer_style_id = $buyer_style_id;
        $receiveDetail->unit_id = $request->unit_id;
        $receiveDetail->received_total_quantity = $request->issued_total_quantity;
        $receiveDetail->status = 'QCI';
        $receiveDetail->grade_a = $request->grade_a;
        $receiveDetail->grade_b = $request->grade_b;
        $receiveDetail->grade_c = $request->grade_c;
        $receiveDetail->grade_d = $request->grade_d;
        $receiveDetail->grade_t = 0;
        $receiveDetail->qc_date = Carbon::now()->toDate();
        $receiveDetail->remarks = $request->remarks;
        $receiveDetail->inserted_by = Auth::id();

        if($receiveDetail->save()){
            if(((integer)$request->grade_t) > 0){
               return 'I';
            }else{
                return 'A';
            }
        }
        return '0';
    }

    public static function returnBuyerId($receive_master_id, $receive_detail_id){
        $data = DB::table('receive_details')
            ->select('buyer_id')
            ->where('receive_master_id', $receive_master_id)
            ->where('counter', $receive_detail_id)
            ->first();
        if($data){
            return $data->buyer_id;
        }

        return 0;
    }

    public static function returnBuyerStyleId($receive_master_id, $receive_detail_id){
        $data = DB::table('receive_details')
            ->select('buyer_style_id')
            ->where('receive_master_id', $receive_master_id)
            ->where('counter', $receive_detail_id)
            ->first();
       // return $data;
        if($data){
            return $data->buyer_style_id;
        }

        return 0;
    }

    public static function returnGarmentsTypeId($receive_master_id, $receive_detail_id){
        $data = DB::table('receive_details')
            ->select('garments_type_id')
            ->where('receive_master_id', $receive_master_id)
            ->where('counter', $receive_detail_id)
            ->first();

        if($data){
            return $data->garments_type_id;
        }

        return 0;
    }

    public static function returnDelete($receive_master_id, $receive_detail_id){
        //$model = Buyer::find($id);

        $data = DB::table('receive_details')
            ->where('receive_master_id', $receive_master_id)
            ->where('counter', $receive_detail_id)
            ->update([
                'status' => 'D',
                'last_updated_by' => Auth::id(),
                ]);

        return $data;
    }

    public static function returnInsertQC($request){
      /* $data = DB::table('receive_details')
            ->select('*')
            ->where('receive_master_id', $request->receive_master_id)
            ->where('counter', $request->counter)
            ->get();
        return $data;*/

        $data = DB::table('receive_details')
            ->where('receive_master_id', $request->receive_master_id)
            ->where('counter', $request->counter)
            ->update([
                'status' => 'QCI',
                'received_total_quantity' => $request->received_total_quantity,
                'qc_date' => $request->qc_date,
                'grade_a' => $request->grade_a,
                'grade_b' => $request->grade_b,
                'grade_c' => $request->grade_c,
                'grade_d' => $request->grade_d,
                'grade_t' => $request->grade_t,
                'last_updated_by' => Auth::id()
            ]);

        return $data;
    }

    public static function returnMasterIdFromComplexStr($data){
        $master_id = substr($data, 0, strpos($data, '-'));
        return $master_id;
    }

    public static function returnDetailIdFromComplexStr($data){
        $master_id = substr($data, (strpos($data, '-')+1));
        return $master_id;
    }

    public static function approveAllQCInserted(){
        //get all qci
        // based on location id
        $locations = Location::getUserLocationIdArray(Auth::id());
        $details = DB::table('receive_details')
                ->join('receive_masters', 'receive_masters.id', '=', 'receive_details.receive_master_id')
                ->select('receive_masters.id AS receive_master_id', 'receive_details.counter', 'receive_masters.receive_date',
                    'receive_details.received_total_quantity', 'receive_details.grade_a', 'receive_details.grade_b', 'receive_masters.location_id',
                    'receive_details.grade_c', 'receive_details.grade_d', 'receive_details.grade_t', 'receive_details.unit_id')
                ->orderBy('receive_masters.receive_date', 'ASC')
                ->whereIn('receive_masters.location_id', $locations)
                ->where('receive_details.status', 'QCI')
                ->get();

        foreach ($details AS $detail){
            self::approveSingleInserted($detail);
        }

        return 1;
    }

    public static function approveSingleQCInserted($receive_master_id, $receive_detail_id){
        $detail = DB::table('receive_details')
            ->join('receive_masters', 'receive_masters.id', '=', 'receive_details.receive_master_id')
            ->select('receive_masters.id AS receive_master_id', 'receive_details.counter', 'receive_masters.receive_date',
                'receive_details.received_total_quantity', 'receive_details.grade_a', 'receive_details.grade_b', 'receive_details.grade_t','receive_masters.location_id',
                'receive_details.grade_c', 'receive_details.grade_d', 'receive_details.grade_t', 'receive_details.unit_id')
            ->orderBy('receive_masters.receive_date', 'ASC')
            ->where('receive_details.receive_master_id', $receive_master_id)
            ->where('receive_details.counter', $receive_detail_id)
            ->first();

        $result =  self::approveSingleInserted($detail);

        return $result;
    }

    public static function approveSingleInserted($request){
        if(Location::hasAccess(Auth::id(),$request->location_id )){
            $stock = new Stock();
            $stock->receive_master_id = $request->receive_master_id;
            $stock->receive_detail_id = $request->counter;
            $stock->receive_date = $request->receive_date;
            $stock->stock_entry_date = Carbon::now();
            $stock->unit_id = $request->unit_id;
            $stock->received_total_quantity = $request->grade_a + $request->grade_b + $request->grade_c + $request->grade_d + $request->grade_t;
            $stock->grade_a = $request->grade_a;
            $stock->grade_b = $request->grade_b;
            $stock->grade_c = $request->grade_c;
            $stock->grade_d = $request->grade_d;
            $stock->grade_t = $request->grade_t;
            $stock->location_id = $request->location_id;
            $stock->inserted_by = Auth::id();
            if($stock->save()){
                $data = DB::table('receive_details')
                    ->where('receive_master_id', $request->receive_master_id)
                    ->where('counter', $request->counter)
                    ->update([
                        'status' => 'QCF',
                        'last_updated_by' => Auth::id(),
                    ]);
                return $data;
            }
            return '0';
        }

        return '0';
    }

    public static function getInsertedList(){
        $locations = Location::getUserLocationIdArray(Auth::id());
        return DB::table('receive_details')
            ->join('receive_masters', 'receive_masters.id', '=', 'receive_details.receive_master_id')
            ->join('locations', 'locations.id', '=', 'receive_masters.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id', 'receive_masters.receive_type', 'receive_masters.receive_date',
                'receive_masters.reference_no', 'receive_masters.receive_from', 'receive_masters.status AS receive_master_status',
                'locations.short_name AS location_short_name', 'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'receive_details.received_total_quantity', 'receive_details.grade_a', 'receive_details.grade_b',
                'receive_details.grade_c', 'receive_details.grade_d', 'receive_details.grade_t', 'receive_details.qc_date',
                'receive_details.qc_c_quantity', 'receive_details.qc_nc_quantity', 'receive_details.counter',
                'receive_details.status AS receive_detail_status', 'receive_details.remarks')
            ->where('receive_details.status', '=', 'I')
            ->where('receive_masters.status', '!=', 'D')
            ->whereIn('receive_masters.location_id', $locations)
            ->orderBy('receive_masters.id', 'ASC')
            ->orderBy('receive_details.counter', 'ASC')
            ->get();
    }

    public static function getQCInsertedList(){
        $locations = Location::getUserLocationIdArray(Auth::id());
        return DB::table('receive_details')
            ->join('receive_masters', 'receive_masters.id', '=', 'receive_details.receive_master_id')
            ->join('locations', 'locations.id', '=', 'receive_masters.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id', 'receive_masters.receive_type', 'receive_masters.receive_date',
                'receive_masters.reference_no', 'receive_masters.receive_from', 'receive_masters.status AS receive_master_status',
                'locations.short_name AS location_short_name', 'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'receive_details.received_total_quantity', 'receive_details.grade_a', 'receive_details.grade_b',
                'receive_details.grade_c', 'receive_details.grade_d', 'receive_details.grade_t', 'receive_details.qc_date',
                'receive_details.qc_c_quantity', 'receive_details.qc_nc_quantity', 'receive_details.counter',
                'receive_details.status AS receive_detail_status', 'receive_details.remarks')
            ->where('receive_details.status', '=', 'QCI')
            ->where('receive_masters.status', '!=', 'D')
            ->whereIn('receive_masters.location_id', $locations)
            ->orderBy('receive_masters.id', 'ASC')
            ->orderBy('receive_details.counter', 'ASC')
            ->get();
    }

    public static function getQCFinishedList(){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('receive_details')
            ->join('receive_masters', 'receive_masters.id', '=', 'receive_details.receive_master_id')
            ->join('locations', 'locations.id', '=', 'receive_masters.location_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('units', 'units.id', '=', 'receive_details.unit_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->select('receive_masters.id AS receive_master_id', 'receive_masters.receive_type', 'receive_masters.receive_date',
                'receive_masters.reference_no', 'receive_masters.receive_from', 'receive_masters.status AS receive_master_status',
                'locations.short_name AS location_short_name', 'buyers.name AS buyer_name', 'buyer_styles.style_no',
                'garments_types.name AS garments_type', 'units.short_unit',
                'receive_details.received_total_quantity', 'receive_details.grade_a', 'receive_details.grade_b',
                'receive_details.grade_c', 'receive_details.grade_d', 'receive_details.grade_t', 'receive_details.qc_date',
                'receive_details.qc_c_quantity', 'receive_details.qc_nc_quantity', 'receive_details.counter',
                'receive_details.status AS receive_detail_status', 'receive_details.remarks')
            ->where('receive_details.status', '=', 'QCF')
            ->where('receive_masters.status', '!=', 'D')
            ->whereIn('receive_masters.location_id', $locations)
            ->orderBy('receive_masters.id', 'DESC')
            ->orderBy('receive_details.counter', 'ASC')
            ->get();
    }
}
