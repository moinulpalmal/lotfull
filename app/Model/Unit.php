<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Unit extends Model
{
    public static function allActiveUnits(){
        return Unit::where('status', '=', 'A')
            ->orderBy('full_unit', 'ASC')
            ->get();
    }

    public static function allUnits(){
        return  Unit::all();
    }

    public static function allNotDeleteUnits(){
        return  Unit::where('status', '!=', 'D')
            ->orderBy('full_unit', 'ASC')
            ->get();
    }

    public static function allDeletedUnits(){
        return  Unit::where('status', '=', 'D')
            ->orderBy('full_unit', 'ASC')
            ->get();
    }

    public static function insertUnit($request){
        $model = new Unit();
        $model->full_unit = trim($request->full_unit);
        $model->short_unit = trim($request->short_unit);
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateUnit($request){
        $model = Unit::find($request->id);
        if($model != null){
            $model->full_unit = trim($request->full_unit);
            $model->short_unit = trim($request->short_unit);
            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = Unit::find($id);
        if($model != null){
            $data = array(
                'full_unit' => $model->full_unit,
                'short_unit' => $model->short_unit,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = Unit::find($id);

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
        $model = Unit::find($id);

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
        $model = Unit::find($id);
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
        return DB::table('units')
            ->select('id', 'full_unit AS name')
            ->where('status', '=', 'A')
            ->orderBy('full_unit', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function allUnitsForSelectField(){
        return DB::table('units')
            ->select('id', 'full_unit', 'status')
            ->where('status', '=', 'A')
            ->orderBy('full_unit', 'ASC')
            ->get();
    }
}
