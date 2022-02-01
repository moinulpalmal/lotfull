<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class Location extends Model
{
    public static function hasAccess($user_id, $location_id){
        $data = DB::table('location_user')
            ->select('user_id', 'location_id')
            ->where('user_id', $user_id)
            ->where('location_id', $location_id)
            ->first();
        if($data != null){
            return true;
        }
        return false;
    }

    public static function getUserLocationIdArray($user_id){
        $data = DB::table('location_user')
            ->select('location_id')
            ->where('user_id', $user_id)
            ->get();


        if(!empty($data)){
            $location_array = array();
            if($data->count() > 1){
                foreach ($data as $item){
                    array_push($location_array, $item->location_id);
                }
            }
            else if($data->count() <= 0){
                $location_array = array(0, 0);
                return $location_array;
            }
            else{
                foreach ($data as $item){
                    array_push($location_array, $item->location_id);
                }

                foreach ($data as $item){
                    array_push($location_array, $item->location_id);
                }
            }
            return $location_array;
        }
        else{
            //return 10;
            $location_array = array(0, 0);
            return $location_array;
        }

    }

    public static function applyLocation($request){
        $user = User::find($request->user_id);
        $locations = Location::allLocationsForSelectField();
        $result = DB::table('location_user')->where('user_id', $user->id)->delete();
        foreach ($locations as $location) {
            if(!empty($request->get('l_'.$location->id))){
                if($request->get('l_'.$location->id) == 'on'){
                    DB::table('location_user')->insert(
                        array('user_id' => $user->id, 'location_id' => $location->id)
                    );
                }
            }
        }
    }

    public static function allActiveLocations(){
        return Location::where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allLocations(){
        return  Location::all();
    }

    public static function allNotDeleteLocations(){
        return  Location::where('status', '!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function allDeletedLocations(){
        return  Location::where('status', '=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function insertLocation($request){
        $model = new Location();
        $model->name = trim($request->name);
        $model->short_name = trim($request->short_name);
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save()){

            return '1';
        }
        return '0';
    }

    public static function updateLocation($request){
        $model = Location::find($request->id);
        if($model != null){
            $model->name = trim($request->name);
            $model->short_name = trim($request->short_name);
            $model->last_updated_by = Auth::id();

            if($model->save()){
                return '2';
            }
            return '0';
        }

        return '0';
    }

    public static function returnForEdit($id){
        $model = Location::find($id);
        if($model != null){
            $data = array(
                'name' => $model->name,
                'short_name' => $model->short_name,
                'id' => $model->id
            );
            return $data;
        }
        return '0';

    }

    public static function returnDelete($id){
        $model = Location::find($id);

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
        $model = Location::find($id);

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
        $model = Location::find($id);
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
        return DB::table('locations')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->pluck("id","name");

        //return $DropDownData;
        //return json_encode($DropDownData);
    }

    public static function allLocationsForSelectField(){
        return DB::table('locations')
            ->select('id', 'name', 'short_name', 'status')
            ->where('status', '=', 'A')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function  allLocationsForSelectFieldByUser($user_id){
        return DB::table('location_user')
            ->join('locations', 'locations.id', '=', 'location_user.location_id')
            ->select('locations.id', 'locations.name', 'locations.short_name', 'locations.status')
            ->where('locations.status', '=', 'A')
            ->where('location_user.user_id', '=', $user_id)
            ->orderBy('locations.name', 'ASC')
            ->get();
    }
}
