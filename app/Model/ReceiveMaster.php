<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceiveMaster extends Model
{
    public static function insertMaster($request){
        //insert receive_master
        $receiveMaster = new ReceiveMaster();

        $receiveMaster->receive_date = $request->receive_date;

        $receiveMaster->receive_type = 'r';
        $receiveMaster->reference_no = $request->reference_no;
        $receiveMaster->receive_from = $request->receive_from;
        //$receiveMaster->receive_from = 1;
        $receiveMaster->location_id = $request->location;
       // $receiveMaster->location_id = 1;
        $receiveMaster->remarks = $request->remarks;

        $receiveMaster->status = "I";

        $receiveMaster->inserted_by = Auth::id();

        if($receiveMaster->save()){
            return $receiveMaster->id;
        }
        return 0;
    }

    public static function returnUpdate($request){
        //return $request->all();
        $receiveMaster = ReceiveMaster::find($request->id);
        //return $receiveMaster;
        if($receiveMaster){
            $receiveMaster->receive_date = $request->receive_date;
            $receiveMaster->reference_no = $request->reference_no;
            $receiveMaster->receive_from = $request->receive_from;
            //$receiveMaster->receive_from = 1;
            $receiveMaster->location_id = $request->location;
            // $receiveMaster->location_id = 1;
            $receiveMaster->remarks = $request->remarks;
            $receiveMaster->last_updated_by = Auth::id();

            if($receiveMaster->save()){
                return '2';
            }
            return '0';
        }

        return '5';
    }

    public static function insertTransferMaster($request){
        //insert receive_master
        $receiveMaster = new ReceiveMaster();

        $receiveMaster->receive_date = Carbon::now()->toDate();

        $receiveMaster->receive_type = 't';
        $receiveMaster->reference_no = $request->reference_no;
        $receiveMaster->receive_from = $request->location_id;
        //$receiveMaster->receive_from = 1;
        $receiveMaster->location_id = $request->issued_to;
        // $receiveMaster->location_id = 1;
        $receiveMaster->remarks = $request->remarks;

        $receiveMaster->status = "I";

        $receiveMaster->inserted_by = Auth::id();

        if($receiveMaster->save()){
            return $receiveMaster->id;
        }
        return 0;
    }

    public static function getAllNotDeletedReceiveMasterListInserted(){
        $locations = Location::getUserLocationIdArray(Auth::id());

        return DB::table('receive_masters')
            ->select('*')
            ->where('status', '=', 'I')
            ->whereIn('location_id', $locations)
            ->orderBy('receive_date', 'ASC')
            ->get();
    }

    public static function  getAllNReceiveMasterListInsertedApi($user_id, $count){
        $locations = Location::getUserLocationIdArray($user_id);

        return DB::table('view_receive_masters')
            ->select('view_receive_masters.*')
            ->where('view_receive_masters.status', '=', 'I')
            ->whereIn('view_receive_masters.location_id', $locations)
            ->orderBy('view_receive_masters.age', 'ASC')
            ->get()
            ->take($count);
    }

    public static function checkUpdateAccess($id){
        $receive_details = DB::table('receive_details')
            ->select('receive_master_id', 'status')
            ->where('receive_master_id', $id)
            ->where('status', '!=', 'D')
            ->get();

        $access = true;
        if($receive_details->count() > 0){
            foreach ($receive_details AS $item){
                if($item->status == 'QCI'){
                    $access = false;
                }
                else if ($item->status == 'QCF'){
                    $access = false;
                }
                else{
                    $access = true;
                }

                if($access == false){
                    break;
                }
            }
        }

        return $access;
    }

    public static function returnDelete($request){
        //$model = Buyer::find($id);

        $data = DB::table('receive_masters')
            ->where('id', $request->id)
            ->update([
                'status' => 'D',
                'last_updated_by' => Auth::id(),
            ]);

        $delete_details =  DB::table('receive_details')
            ->where('receive_master_id', $request->id)
            ->update([
                'status' => 'D',
                'last_updated_by' => Auth::id(),
            ]);

        return $data;
    }

}
