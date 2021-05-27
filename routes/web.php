<?php

use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

//check by company_id in all relations

Auth::routes(['verify' => false, 'register' => false]);


Route::group(['middleware' => 'auth'], function(){
	Route::view('/', 'home');

    Route::group(['prefix' => 'trade'], function() {
        Route::get("mtrade-good/print", function() {
            return view("trade.mtrade-good.print");
        })->name("print");

        Route::resource('mtrade-attributes', 'Trade\MtradeAttributeController');
        Route::resource('mtrade-category-goods', 'Trade\MtradeCategoryGoodController');
        Route::resource('mtrade-good-attribute', 'Trade\MtradeGoodAttributeController');
        Route::resource('mtrade-good', 'Trade\MtradeGoodController');
    });

    Route::group(['prefix' => 'production'], function() {
    	Route::resource('category-primary-product', 'Production\MprodCategoryPrimaryProductController');
    });
});

Route::group(['prefix' => 'ajax'], function() {
    Route::get('m-trade-attribute-values/{mtrade_good_attribute_id}', 'Trade\MtradeGoodController@ajaxGetAttributeValues');
});
