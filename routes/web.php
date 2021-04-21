<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'password' => false,
    'verify' => false,
  ]);

Route::get('ChangeDefaultPassword', 'ChangeDefaultPasswordController@index');
Route::post('ChangeDefPass', 'ChangeDefaultPasswordController@ChangeDefPass');


/*---------------------------------------------------------------------------------------------------------------------------------------------*/
//Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');

/*---------------------------------------------------------------------------------------------------------------------------------------------*/

//-- JSON
Route::get('getCust', 'JSONController@getCust');
Route::get('getCustID/id={id}', 'JSONController@getCustID');
Route::get('checkEmail/id={id}', 'JSONController@checkEmail');
Route::get('checkCustomer/id={id}', 'JSONController@checkCustomer');
Route::post('listCustomer', 'JSONController@listCustomer')->name('listCustomer');
Route::get('listAllCustomer', 'JSONController@listAllCustomer')->name('listAllCustomer');
Route::get('getCustDetails/id={id}', 'JSONController@getCustDetails');
Route::get('getConsignee/id={id}', 'JSONController@getConsignee');
Route::post('listSalesman', 'JSONController@listSalesman')->name('listSalesman');
Route::get('listPayment', 'JSONController@listPayment');

//-- User Mgmt
Route::get('MyAccount', 'MyAccountController@index')->name('MyAccount');
Route::get('ChangePass', 'ChangePassController@index')->name('ChangePass');
Route::post('ActChangePass', 'ChangePassController@ActChangePass')->name('ActChangePass');
Route::get('AddUser', 'AddUserController@index')->name('AddUser');
Route::post('listUser', 'AddUserController@listUser')->name('listUser');
Route::post('saveUser', 'AddUserController@saveUser')->name('saveUser');
Route::get('getUser/id={id}&id2={id2}', 'AddUserController@getUser');
Route::get('delUser/id={id}&id2={id2}', 'AddUserController@delUser');
Route::post('editUser', 'AddUserController@editUser')->name('editUser');
Route::get('AddSales', 'AddSalesController@index')->name('AddSales');
Route::post('saveSales', 'AddSalesController@saveSales')->name('saveSales');

//-- Cust. Order
Route::get('CustReg', 'CustRegController@index')->name('CustReg');
Route::post('SaveCustReg', 'CustRegController@SaveCustReg')->name('SaveCustReg');
Route::get('RegisteredCust', 'RegisteredCustController@index')->name('RegisteredCust');
Route::get('listRegisteredUser/id={id}', 'RegisteredCustController@listRegisteredUser');
Route::get('CreateOrder', 'CreateOrderController@index')->name('CreteOrder');
Route::get('getOrderHeader/id={id}', 'CreateOrderController@getOrderHeader');
Route::post('updateOrderHeader', 'CreateOrderController@updateOrderHeader');
Route::get('listCommodity', 'CreateOrderController@listCommodity');
Route::get('listBrand', 'CreateOrderController@listBrand');
Route::get('listCoat', 'CreateOrderController@listCoat');
Route::get('listGrade', 'CreateOrderController@listGrade');
Route::get('listAppl', 'CreateOrderController@listAppl');
Route::get('allThickness', 'CreateOrderController@allThickness');
Route::get('commodityThickness/id={id}', 'CreateOrderController@commodityThickness');
Route::get('brandThickness/id={id}', 'CreateOrderController@brandThickness');
Route::get('getThickness/a={a}&b={b}', 'CreateOrderController@getThickness');
Route::get('allWidth', 'CreateOrderController@allWidth');
Route::get('commodityWidth/id={id}', 'CreateOrderController@commodityWidth');
Route::get('brandWidth/id={id}', 'CreateOrderController@brandWidth');
Route::get('getWidth/a={a}&b={b}', 'CreateOrderController@getWidth');
Route::get('allColour', 'CreateOrderController@allColour');
Route::get('getColour/id={id}', 'CreateOrderController@getColour');
Route::post('getProduct', 'CreateOrderController@getProduct');
Route::get('cekHarga/id={id}', 'CreateOrderController@cekHarga');
Route::post('getItemDetail', 'CreateOrderController@getItemDetail');
Route::post('saveOrderItem', 'CreateOrderController@saveOrderItem');
Route::post('deleteOrderItem', 'CreateOrderController@deleteOrderItem');
Route::post('submitOrder', 'CreateOrderController@submitOrder');
Route::post('deleteOrder', 'CreateOrderController@deleteOrder');
Route::post('confirmOrder', 'CreateOrderController@confirmOrder');
Route::get('editOrderItem/id={id}', 'CreateOrderController@editOrderItem');
Route::post('saveEditOrderItem', 'CreateOrderController@saveEditOrderItem');
Route::post('getPrice', 'CreateOrderController@getPrice');

Route::post('getQuoteDetail', 'CreateOrderController@getQuoteDetail');
Route::post('getItemDetail2', 'CreateOrderController@getItemDetail2');
Route::post('submitApproval', 'CreateOrderController@submitApproval');



//-- Cust.Order/List Order
Route::get('ListOrder', 'ListOrderController@index')->name('ListOrder');
Route::post('getListOrder', 'ListOrderController@getListOrder');
Route::post('detailHdr', 'ListOrderController@detailHdr');
Route::post('trackOrder', 'ListOrderController@trackOrder');
Route::post('trackOrderLpm', 'ListOrderController@trackOrderLpm');

//-- Cust.Order/rint Preview
Route::get('PrintPreview/id={id}', 'PrintPreviewController@index');

//--  Cust.Order/Upload Image
Route::get('UploadImg/id={id}', 'UploadImgController@index');
Route::post('ImgUpload', 'UploadImgController@upload')->name('ImgUpload');
Route::get('ImgFetch', 'UploadImgController@fetch')->name('ImgFetch');
Route::get('ImgDelete', 'UploadImgController@delete')->name('ImgDelete');


//-- Dashboard
Route::post('customerDashboard','HomeController@customerDashboard');
Route::post('customerDashboardbyID','HomeController@customerDashboardbyID');






