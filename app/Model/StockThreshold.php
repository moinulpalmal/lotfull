<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockThreshold extends Model
{
    public static function returnColorCode($day_count){
        $data = DB::table('stock_thresholds')
            ->select('id', 'color_code')
            ->where('status', '!=', 'D')
            ->where('min_day', '<=', $day_count)
            ->where('max_day', '>=', $day_count)
            ->orderBy('min_day', 'ASC')
            ->first();
        if($data != null){
            return $data->color_code;
        }

        return "#FFFFFF";

    }

    public static function returnStatus($day_count){
        $data = DB::table('stock_thresholds')
            ->select('id', 'stock_threshold_status')
            ->where('status', '!=', 'D')
            ->where('min_day', '<=', $day_count)
            ->where('max_day', '>=', $day_count)
            ->orderBy('min_day', 'ASC')
            ->first();
        if($data != null){
            return $data->stock_threshold_status;
        }

        return "Not Configured";

    }

    public static function allActiveStockThresholds(){
        return StockThreshold::where('status', '=', 'A')
            ->orderBy('min_day', 'ASC')
            ->get();
    }

    public static function allStockThresholds(){
        return  StockThreshold::all();
    }

    public static function allNotDeleteStockThresholds(){
        return  StockThreshold::where('status', '!=', 'D')
            ->orderBy('min_day', 'ASC')
            ->get();
    }

    public static function allDeletedStockThresholds(){
        return  StockThreshold::where('status', '=', 'D')
            ->orderBy('min_day', 'ASC')
            ->get();
    }

    public static function insertStockThreshold($request){
        $model = new StockThreshold();
        $model->stock_threshold_status = trim($request->stock_threshold_status);
        $model->color_code = $request->color_code;
        $model->min_day = $request->min_day;
        $model->max_day = $request->max_day;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateStockThreshold($request){
        $model = StockThreshold::find($request->id);
        if($model != null){
            $model->stock_threshold_status = trim($request->stock_threshold_status);
            $model->color_code = $request->color_code;
            $model->min_day = $request->min_day;
            $model->max_day = $request->max_day;
            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = StockThreshold::find($id);
        if($model != null){
            $data = array(
                'stock_threshold_status' => $model->stock_threshold_status,
                'color_code' => $model->color_code,
                'min_day' => $model->min_day,
                'max_day' => $model->max_day,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = StockThreshold::find($id);

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
        $model = StockThreshold::find($id);

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
        $model = StockThreshold::find($id);
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
        return DB::table('stock_thresholds')
            ->select('id', 'stock_threshold_status AS name')
            ->where('status', '=', 'A')
            ->orderBy('stock_threshold_status', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function allStockThresholdsForSelectField(){
        return DB::table('stock_thresholds')
            ->select('id', 'stock_threshold_status AS name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('stock_threshold_status', 'ASC')
            ->get();
    }
}
