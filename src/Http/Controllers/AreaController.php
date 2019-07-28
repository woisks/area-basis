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
     * country. 2019/6/10 21:13.
     *
     *
     * @return JsonResponse
     */
    public function country()
    {
        $country = $this->countryRepo->all();

        $data = [];

        foreach ($country as $v) {
            if ($v->region == 1) {
                $data['Africa'][] = $v;
            } elseif ($v->region == 2) {
                $data['Asia'][] = $v;
            } elseif ($v->region == 3) {
                $data['Europe'][] = $v;
            } elseif ($v->region == 4) {
                $data['Latin America and the Caribbean'][] = $v;
            } elseif ($v->region == 5) {
                $data['Oceania'][] = $v;
            } elseif ($v->region == 6) {
                $data['Northern America'][] = $v;
            }

        }
        return res(200, 'success', $data);
    }


    /**
     * province. 2019/7/28 18:33.
     *
     *
     * @return JsonResponse
     */
    public function province()
    {
        $province = $this->provinceRepo->all();

        $data = [];

        foreach ($province as $v) {
            if ($v->region == 1) {
                $data['华东地区'][] = $v;
            } elseif ($v->region == 2) {
                $data['华北东北'][] = $v;
            } elseif ($v->region == 3) {
                $data['华南西南'][] = $v;
            } elseif ($v->region == 4) {
                $data['华中西北'][] = $v;
            } elseif ($v->region == 5) {
                $data['港澳台钓'][] = $v;
            }
        }

        return res(200, 'success', $data);
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
