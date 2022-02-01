<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuyerStyle extends Model
{
    public static function allActiveBuyerStyles(){
        return DB::table('buyer_styles')
            ->join('buyers', 'buyers.id', '=', 'buyer_styles.buyer_id')
            ->select('buyers.name AS buyer_name', 'buyer_styles.style_no', 'buyer_styles.id',  'buyer_styles.status')
            ->where('buyer_styles.status', '=', 'A')
            ->orderBy('buyers.name', 'ASC')
            ->orderBy('buyer_styles.style_no', 'ASC')
            ->get();
    }

    public static function allBuyerStyles(){
        return DB::table('buyer_styles')
            ->join('buyers', 'buyers.id', '=', 'buyer_styles.buyer_id')
            ->select('buyers.name AS buyer_name', 'buyer_styles.style_no', 'buyer_styles.id',  'buyer_styles.status')
            ->orderBy('buyers.name', 'ASC')
            ->orderBy('buyer_styles.style_no', 'ASC')
            ->get();
    }

    public static function allNotDeleteBuyerStyles(){
        return DB::table('buyer_styles')
            ->join('buyers', 'buyers.id', '=', 'buyer_styles.buyer_id')
            ->select('buyers.name AS buyer_name', 'buyer_styles.style_no', 'buyer_styles.id',  'buyer_styles.status')
            ->where('buyer_styles.status', '!=', 'D')
            ->orderBy('buyers.name', 'ASC')
            ->orderBy('buyer_styles.style_no', 'ASC')
            ->get();
    }

    public static function allDeletedBuyerStyles(){
        return DB::table('buyer_styles')
            ->join('buyers', 'buyers.id', '=', 'buyer_styles.buyer_id')
            ->select('buyers.name AS buyer_name', 'buyer_styles.style_no', 'buyer_styles.id',  'buyer_styles.status')
            ->where('buyer_styles.status', '=', 'D')
            ->orderBy('buyers.name', 'ASC')
            ->orderBy('buyer_styles.style_no', 'ASC')
            ->get();
    }

    public static function insertBuyerStyle($request){
        $model = new BuyerStyle();
        $model->buyer_id = $request->buyer;
        $model->style_no = trim($request->style_no);
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function returnBuyerStyleIdWithInsert($buyer_id, $style_no){
        if(self::isBuyerStyleNoExists($buyer_id, $style_no)){
            $data = DB::table('buyer_styles')
                ->select('id')
                ->where('buyer_id', '=', $buyer_id)
                ->where('style_no', '=', trim($style_no))
                ->where('status', '!=', 'D')
                ->orderBy('style_no', 'ASC')
                ->first();

            return $data->id;
        }
        else{
            $model = new BuyerStyle();
            $model->buyer_id = $buyer_id;
            $model->style_no = trim($style_no);
            $model->inserted_by = Auth::id();
            $model->status = 'A';
            $model->save();
            return $model->id;
        }
    }

    public static function updateBuyerStyle($request){
        $model = BuyerStyle::find($request->id);
        if($model != null){
            $model->buyer_id = $request->buyer;
            $model->style_no = trim($request->style_no);
            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function isBuyerStyleNoExists($buyer_id, $style_no){
        $data = DB::table('buyer_styles')
            ->select('id')
            ->where('buyer_id', '=', $buyer_id)
            ->where('style_no', '=', trim($style_no))
            ->where('status', '!=', 'D')
            ->orderBy('style_no', 'ASC')
            ->get();

        if($data->count() > 0){
            return true;
        }
        return false;
    }

    public static function returnForEdit($id){
        $model = BuyerStyle::find($id);
        if($model != null){
            $data = array(
                'buyer' => $model->buyer_id,
                'style_no' => $model->style_no,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = BuyerStyle::find($id);

        if($model != null){
            $model->status = 'D';
            if($model->save()){
                return '1';
            }

            return '0';
        }
        return '0';
    }

    public static function returnActivate($id){
        $model = BuyerStyle::find($id);

        if($model != null){
            $model->status = 'A';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }

    public static function returnDeActivate($id){
        $model = BuyerStyle::find($id);
        if($model != null){
            $model->status = 'I';
            if($model->save()){
                return '1';
            }
            return '0';
        }
        return '0';
    }

    public static function getDropDownList(){
        return DB::table('buyer_styles')
            ->select('id', 'style_no AS name')
            ->where('status', '=', 'A')
            ->orderBy('style_no', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function getDropDownListByBuyer($buyer_id){
        return DB::table('buyer_styles')
            ->select('id', 'style_no AS name')
            ->where('buyer_id', '=', $buyer_id)
            ->where('status', '=', 'A')
            ->orderBy('style_no', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function allBuyerStylesForSelectField(){
        return DB::table('buyer_styles')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }
}
