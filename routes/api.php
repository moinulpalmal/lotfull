<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('settings/buyer/setup/not-deleted-list', 'Settings\Api\BuyerController@allNotDeletedBuyers');
Route::get('settings/buyer/style/not-deleted-list', 'Settings\Api\BuyerStyleController@allNotDeletedBuyerStyles');
Route::get('settings/vendor/setup/not-deleted-list', 'Settings\Api\VendorController@allNotDeletedVendors');
Route::get('settings/garments-type/setup/not-deleted-list', 'Settings\Api\GarmentsTypeController@allNotDeletedGarmentsTypes');
Route::get('settings/unit/setup/not-deleted-list', 'Settings\Api\UnitController@allNotDeletedUnits');

Route::get('receive/list/master/inserted/{user_id}', 'Receive\API\MasterController@listInserted');

Route::get('receive/list/detail/inserted/{user_id}', 'Receive\API\DetailController@listInserted');
Route::get('receive/list/detail/qc-inserted/{user_id}', 'Receive\API\DetailController@listQCInserted');
Route::get('receive/list/detail/qc-finished/{user_id}', 'Receive\API\DetailController@listQCFinished');
Route::get('receive/list/transfer/inserted/{user_id}', 'Receive\API\TransferController@transferInserted');
Route::get('receive/list/transfer/approved/{count}/{user_id}', 'Receive\API\TransferController@transferAccepted');


Route::get('issue/stock/current-active/{user_id}', 'Issue\API\StockController@currentStock');
Route::get('issue/stock/current-in-active/{user_id}', 'Issue\API\StockController@inActiveStock');
Route::get('issue/stock/old/{count}/{user_id}', 'Issue\API\StockController@oldStock');

Route::get('issue/detail/issued/{count}/{user_id}', 'Issue\API\IssueController@issued');
Route::get('issue/detail/transferred/{count}/{user_id}', 'Issue\API\IssueController@transferred');
