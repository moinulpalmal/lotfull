<?php

namespace App\Http\Controllers\Receive;

use App\Http\Controllers\Controller;
use App\Model\Buyer;
use App\Model\Factory;
use App\Model\GarmentsType;
use App\Model\Location;
use App\Model\ReceiveDetail;
use App\Model\ReceiveImage;
use App\Model\ReceiveMaster;
use App\Model\Unit;
use App\View_Model\ReceiveVM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InsertController extends Controller
{
    public function new(){
        $factories = Factory::allFactoriesForSelectField();
        $buyers = Buyer::allBuyersForSelectField();
        $units = Unit::allUnitsForSelectField();
        $garments_types = GarmentsType::allGarmentsTypesForSelectField();
        //return Auth::id();
        $locations = Location::allLocationsForSelectFieldByUser(Auth::id());
        //return $locations;

        return view('receive.new', compact('factories', 'buyers',
            'units', 'garments_types' , 'locations'));
    }

    public function save(Request $request){

        $masterId = ReceiveMaster::insertMaster($request);
        if($masterId > 0){
           return ReceiveDetail::insertDetailBulk($masterId, $request);
        }

        return '0';
    }

    public function imageUpload(){
        $receive_froms = ReceiveVM::getReceiveFromForSelectField();

        //return $receive_froms;
        $buyers = Buyer::allBuyersForSelectField();
        $garments_types = GarmentsType::allGarmentsTypesForSelectField();
        //return Auth::id();
        $locations = Location::allLocationsForSelectFieldByUser(Auth::id());


        return view('receive.image-upload', compact('receive_froms', 'buyers',
            'garments_types', 'locations'));
    }

    public function imageUploadSearch(Request $request){
        $departments = ReceiveVM::receiveListForImageUpload($request);
        return view('receive.image-upload-result', compact('departments'));
    }

    public function imageUploadForm($master_id, $detail_id){
        $data = DB::table('receive_details')
            ->join('receive_masters', 'receive_masters.id', '=', 'receive_details.receive_master_id')
            ->join('garments_types', 'garments_types.id', '=', 'receive_details.garments_type_id')
            ->join('buyers', 'buyers.id', '=', 'receive_details.buyer_id')
            ->join('locations', 'locations.id', '=', 'receive_masters.location_id')
            ->join('buyer_styles', 'buyer_styles.id', '=', 'receive_details.buyer_style_id')
            ->select('receive_details.receive_master_id', 'receive_details.counter', 'receive_masters.location_id',
                'buyers.name AS buyer_name', 'buyer_styles.style_no', 'garments_types.name AS garments_type', 'receive_masters.reference_no',
                'locations.name AS location_name', 'receive_masters.receive_from', 'receive_masters.receive_type')
            ->where('receive_masters.id', $master_id)
            ->where('receive_details.counter', $detail_id)
            ->where('receive_details.status', '!=', 'D')
            ->where('receive_masters.status', '!=', 'D')
            ->get();

        //return $data;
        if($data->count() == 1){
            $target = null;
            foreach ($data as $item){
                $target = $item;
            }
            if(Location::hasAccess(Auth::id(), $item->location_id)){
                $images = ReceiveImage::getAllNotDeletedImages($master_id, $detail_id);
                return view('receive.image-upload-from', compact('target', 'images'));
            }
            return redirect()->route('receive.image-upload');
        }
        return redirect()->route('receive.image-upload');
    }

    public function saveImageUpload(Request $request){
        $this->validate($request, [
            'image' => 'required',
            'image.*'  => 'mimes:jpeg,png,jpg',
        ]);

        $result = ReceiveImage::insertReceiveImage($request);
        if($result == '1'){
            //return redirect()->route('receive.image-upload');
            return redirect()->to(route('receive.image-upload-form',
                ['master_id' => $request->receive_master_id, 'detail_id' => $request->receive_detail_id,]))->with('success','Image upload successfully!');
        }
        else{
            return redirect()->to(route('receive.image-upload-form',
                ['master_id' => $request->receive_master_id, 'detail_id' => $request->receive_detail_id,]))->with('error','Image upload un-successfully!');

        }

       /* return redirect()->route('receive.image-upload-form',
            ['master_id' => $request->receive_master_id, 'detail_id' => $request->receive_detail_id,]);*/
        //return $request->all();
    }

    public function deleteImage(Request $request){
        return ReceiveImage::returnDelete($request->id);
    }

    public function activateImage(Request $request){
        return ReceiveImage::returnActive($request->id);
    }

    public function deActivateImage(Request $request){
        return ReceiveImage::returnInActive($request->id);
    }

}
