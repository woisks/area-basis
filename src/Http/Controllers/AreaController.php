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

namespace Woisks\AreaBasis\Http\Controllers;


use Woisks\AreaBasis\Models\Services\AreaService;

/**
 * Class AreaController.
 *
 * @package Woisks\AreaBasis\Http\Controllers
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 21:13
 */
class AreaController extends BaseController
{
    /**
     * areaService.  2019/6/10 21:13.
     *
     * @var  \Woisks\AreaBasis\Models\Services\AreaService
     */
    private $areaService;

    /**
     * AreaController constructor. 2019/6/10 21:13.
     *
     * @param \Woisks\AreaBasis\Models\Services\AreaService $areaService
     *
     * @return void
     */
    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }


    public function area($province, $province_id, $city_id, $county_id)
    {
        dd($province, $province_id, $city_id, $county_id);
    }

    /**
     * country. 2019/6/10 21:13.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function country()
    {
        return $this->areaService->country();
    }

    /**
     * province. 2019/6/10 21:13.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function province()
    {
        return $this->areaService->province();
    }

    /**
     * city. 2019/6/10 21:19.
     *
     * @param $province_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function city($province_id)
    {
        return $this->areaService->city($province_id);
    }

    /**
     * county. 2019/6/10 21:19.
     *
     * @param $city_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function county($city_id)
    {
        return $this->areaService->county($city_id);
    }

    /**
     * town. 2019/6/10 21:19.
     *
     * @param $county_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function town($county_id)
    {
        return $this->areaService->town($county_id);
    }

}