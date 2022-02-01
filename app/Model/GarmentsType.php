<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GarmentsType extends Model
{
    public static function allActiveGarmentsTypes(){
        return GarmentsType::where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allGarmentsTypes(){
        return  GarmentsType::all();
    }

    public static function allNotDeleteGarmentsTypes(){
        return  GarmentsType::where('status', '!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allDeletedGarmentsTypes(){
        return  GarmentsType::where('status', '=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function insertGarmentsType($request){
        $model = new GarmentsType();
        $model->name = trim($request->name);
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateGarmentsType($request){
        $model = GarmentsType::find($request->id);
        if($model != null){
            $model->name = trim($request->name);
            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = GarmentsType::find($id);
        if($model != null){
            $data = array(
                'name' => $model->name,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = GarmentsType::find($id);

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
        $model = GarmentsType::find($id);

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
        $model = GarmentsType::find($id);
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
        return DB::table('garments_types')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function allGarmentsTypesForSelectField(){
        return DB::table('garments_types')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }
}
