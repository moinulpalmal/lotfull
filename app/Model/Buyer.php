<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Buyer extends Model
{
    public static function allActiveBuyers(){
        return Buyer::where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allBuyers(){
        return  Buyer::all();
    }

    public static function allNotDeleteBuyers(){
        return  Buyer::where('status', '!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allDeletedBuyers(){
        return  Buyer::where('status', '=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function insertBuyer($request){
        $model = new Buyer();
        $model->name = trim($request->name);
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateBuyer($request){
        $model = Buyer::find($request->id);
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
        $model = Buyer::find($id);
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
        $model = Buyer::find($id);

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
        $model = Buyer::find($id);

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
        $model = Buyer::find($id);
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
        return DB::table('buyers')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function allBuyersForSelectField(){
        return DB::table('buyers')
            ->select('id', 'name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }
}
