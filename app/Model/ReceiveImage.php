<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;

class ReceiveImage extends Model
{
    public static function insertReceiveImage($request){
        if(!empty($request->get('receive_master_id'))){
           // $i = 1;
            foreach($request->get('style_no') as $key => $v){
                $receiveDetail = new ReceiveImage();
                $receiveDetail->receive_master_id = $request->receive_master_id;
                $receiveDetail->receive_detail_id = $request->receive_detail_id;
                $receiveDetail->counter = self::returnLastCounter($request->receive_master_id, $request->receive_detail_id);
                $url = self::uploadImage($request->image[$key], $request->receive_master_id, $request->receive_detail_id, $receiveDetail->counter);
                $receiveDetail->image = $url;
                //upload image
                $receiveDetail->status = 'A';
                $receiveDetail->inserted_by = Auth::id();
                $receiveDetail->save();
                //$i++;
            }
            return '1';
        }

        return '0';
    }

    private static function uploadImage($image, $masterId, $detailId, $counter){
        $primary_image = $image;
        //$primary_image = Image::make($primary_image)->resize(250, 250);
        $manager = new ImageManager(array('driver' => 'gd'));
        //return
        //$primary_image =  Image::make($primary_image)->resize(300, 200)->save('foo.jpg');
        //$imageName = $primary_image->getClientOriginalName();
        $extension = $primary_image->getClientOriginalExtension();
        $value = ".";
        $uploadImageName = time().$masterId.$detailId.$counter.$value.$extension;
        $directory = 'upload/style/images/';
        $imageUrl = $directory.$uploadImageName;
        //$primary_image->move($directory, $uploadImageName);
       // $compressed_image = $manager->make($primary_image)->fit(2048, 2048);
        $compressed_image = $manager->make($primary_image->getRealPath())->resize(2048, 2048, function($constraint)
                                {
                                    $constraint->aspectRatio();
                                });
        $compressed_image->save($imageUrl);
        //$result = $manager->make($primary_image)->resize(250, 250)->save($imageUrl);

        return $imageUrl;
    }

    private static function returnLastCounter($master_id, $detail_id){
        $value = 1;
        $result = DB::table('view_max_counter_rc_image')
                    ->select('max_counter')
                    ->where('receive_master_id', $master_id)
                    ->where('receive_detail_id', $detail_id)
                    ->get();

        if($result->count() == 1){
            //$target = null;
            foreach ($result AS $item){
                $value = (integer) $item->max_counter;
            }

            return $value;
        }
        return $value;
    }

    public static function returnDelete($id){
        //$model = Buyer::find($id);

        $data = DB::table('receive_images')
            ->where('id', $id)
            ->update([
                'status' => 'D',
                'last_updated_by' => Auth::id(),
            ]);

        if($data == 1){
            //remove from server
            $results = DB::table('receive_images')
                ->select('image')
                ->where('id', $id)
                ->get();

            foreach ($results AS $item){
                if(file_exists(public_path().'/'.$item->image)) {
                    unlink(public_path().'/'.$item->image);
                }
            }
            return $data;
        }

        return $data;
    }

    public static function returnActive($id){

        $data = DB::table('receive_images')
            ->where('id', $id)
            ->update([
                'status' => 'A',
                'last_updated_by' => Auth::id(),
            ]);

        return $data;
    }

    public static function returnInActive($id){
        $data = DB::table('receive_images')
            ->where('id', $id)
            ->update([
                'status' => 'I',
                'last_updated_by' => Auth::id(),
            ]);

        return $data;
    }

    public static function getAllNotDeletedImages($master_id, $detail_id){
        $images = DB::table('receive_images')
            ->select('*')
            ->where('receive_master_id', $master_id)
            ->where('receive_detail_id', $detail_id)
            ->where('status', '!=', 'D')
            ->get();
        return $images;
    }

    public static function getAllActiveImages($master_id, $detail_id){
        $images = DB::table('receive_images')
            ->select('*')
            ->where('receive_master_id', $master_id)
            ->where('receive_detail_id', $detail_id)
            ->where('status', '=', 'A')
            ->get();
        return $images;
    }

    public static function getAllDeletedImages($master_id, $detail_id){
        $images = DB::table('receive_images')
            ->select('*')
            ->where('receive_master_id', $master_id)
            ->where('receive_detail_id', $detail_id)
            ->where('status', '=', 'D')
            ->get();
        return $images;
    }

    public static function getAllInActiveImages($master_id, $detail_id){
        $images = DB::table('receive_images')
            ->select('*')
            ->where('receive_master_id', $master_id)
            ->where('receive_detail_id', $detail_id)
            ->where('status', '=', 'I')
            ->get();
        return $images;
    }
}
