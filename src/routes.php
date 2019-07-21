<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <bolelin@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

Route::prefix('area')
     ->namespace('Woisks\AreaBasis\Http\Controllers')
     ->group(function () {
         
         Route::get('/', 'AreaController@country');
         Route::get('province', 'AreaController@province');
         Route::get('city/{province_id}', 'AreaController@city');
         Route::get('county/{city_id}', 'AreaController@county');
         Route::get('town/{county_id}', 'AreaController@town');
     });