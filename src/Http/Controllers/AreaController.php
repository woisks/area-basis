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


use Illuminate\Http\JsonResponse;
use Woisks\AreaBasis\Models\Repository\ChinaCityRepository;
use Woisks\AreaBasis\Models\Repository\ChinaCountyRepository;
use Woisks\AreaBasis\Models\Repository\ChinaProvinceRepository;
use Woisks\AreaBasis\Models\Repository\ChinaTownRepository;
use Woisks\AreaBasis\Models\Repository\CountryRepository;

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
     * countryRepo.  2019/7/28 18:33.
     *
     * @var  CountryRepository
     */
    private $countryRepo;
    /**
     * provinceRepo.  2019/7/28 18:33.
     *
     * @var  ChinaProvinceRepository
     */
    private $provinceRepo;
    /**
     * cityRepo.  2019/7/28 18:33.
     *
     * @var  ChinaCityRepository
     */
    private $cityRepo;
    /**
     * countyRepo.  2019/7/28 18:33.
     *
     * @var  ChinaCountyRepository
     */
    private $countyRepo;
    /**
     * townRepo.  2019/7/28 18:33.
     *
     * @var  ChinaTownRepository
     */
    private $townRepo;


    /**
     * AreaController constructor. 2019/7/28 18:33.
     *
     * @param CountryRepository $countryRepo
     * @param ChinaProvinceRepository $provinceRepo
     * @param ChinaCityRepository $cityRepo
     * @param ChinaCountyRepository $countyRepo
     * @param ChinaTownRepository $townRepo
     *
     * @return void
     */
    public function __construct(CountryRepository $countryRepo,
                                ChinaProvinceRepository $provinceRepo,
                                ChinaCityRepository $cityRepo,
                                ChinaCountyRepository $countyRepo,
                                ChinaTownRepository $townRepo)
    {
        $this->countryRepo  = $countryRepo;
        $this->provinceRepo = $provinceRepo;
        $this->cityRepo     = $cityRepo;
        $this->countyRepo   = $countyRepo;
        $this->townRepo     = $townRepo;
    }

    /**
     * country. 2019/8/1 16:06.
     *
     *
     * @return JsonResponse
     */
    public function country()
    {
        //如果存在config文件直接返回
        $config = config('country');
        if (!$config) {

            $country = $this->countryRepo->all();
            $data    = [];
            foreach ($country as $v) {
                if ($v->region == 1) {
                    //Africa
                    $data['非洲'][] = $v->toArray();
                } elseif ($v->region == 2) {
                    //Asia
                    $data['亚洲'][] = $v->toArray();
                } elseif ($v->region == 3) {
                    //Europe
                    $data['欧洲'][] = $v->toArray();
                } elseif ($v->region == 4) {
                    //South America
                    $data['南美洲'][] = $v->toArray();
                } elseif ($v->region == 5) {
                    //Oceania
                    $data['大洋洲'][] = $v->toArray();
                } elseif ($v->region == 6) {
                    //Northern America
                    $data['北美洲'][] = $v->toArray();
                }
            }
            //生成静态Config文件
            config_toFile('country', $data);
            return res(200, 'success', $data);
        }

        return res(200, 'success', $config);

    }


    /**
     * province. 2019/7/28 18:33.
     *
     *
     * @return JsonResponse
     */
    public function province()
    {
        //如果存在config文件直接返回
        $config = config('province');
        if (!$config) {

            $province = $this->provinceRepo->all();
            $data     = [];
            foreach ($province as $v) {
                if ($v->region == 1) {
                    $data['华东地区'][] = $v->toArray();
                } elseif ($v->region == 2) {
                    $data['华北东北'][] = $v->toArray();
                } elseif ($v->region == 3) {
                    $data['华南西南'][] = $v->toArray();
                } elseif ($v->region == 4) {
                    $data['华中西北'][] = $v->toArray();
                } elseif ($v->region == 5) {
                    $data['港澳台钓'][] = $v->toArray();
                }
            }

            //生成静态Config文件
            config_toFile('province', $data);
            return res(200, 'success', $data);
        }
        return res(200, 'success', $config);
    }


    /**
     * city. 2019/7/28 18:33.
     *
     * @param $province_id
     *
     * @return JsonResponse
     */
    public function city($province_id)
    {
        //验证省份ID参数合法
        if (strlen($province_id) !== 6 && !is_int($province_id)) {

            return res(422, 'param province id error');
        }

        $city = $this->cityRepo->get($province_id);

        if ($city->isEmpty()) {
            return res(404, 'param error province id not exists');
        }

        return res(200, 'success', $city);
    }


    /**
     * county. 2019/7/28 18:33.
     *
     * @param $city_id
     *
     * @return JsonResponse
     */
    public function county($city_id)
    {
        //tips:town 直辖县级
        if (strlen($city_id) !== 6 && !is_int($city_id)) {

            return res(422, 'param city id error');
        }

        $county = $this->countyRepo->get($city_id);

        if ($county->isEmpty()) {
            return res(404, 'param error city id not exists');
        }

        return res(200, 'success', $county);
    }


    /**
     * town. 2019/7/28 18:33.
     *
     * @param $county_id
     *
     * @return JsonResponse
     */
    public function town($county_id)
    {
        //tips:town 直辖县级
        if (strlen($county_id) !== 6 && !is_int($county_id)) {

            return res(422, 'param county id error');
        }

        $town = $this->townRepo->get($county_id);

        if ($town->isEmpty()) {
            return res(404, 'param error county id not exists');
        }

        return res(200, 'success', $town);
    }

}
