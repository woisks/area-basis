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

namespace Woisks\AreaBasis\Models\Services;


use Woisks\AreaBasis\Models\Repository\ChinaCityRepository;
use Woisks\AreaBasis\Models\Repository\ChinaCountyRepository;
use Woisks\AreaBasis\Models\Repository\ChinaProvinceRepository;
use Woisks\AreaBasis\Models\Repository\ChinaTownRepository;
use Woisks\AreaBasis\Models\Repository\CountryRepository;

/**
 * Class AreaService.
 *
 * @package Woisks\AreaBasis\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 21:14
 */
class AreaService
{
    /**
     * countryRepo.  2019/6/10 21:14.
     *
     * @var  \Woisks\AreaBasis\Models\Repository\CountryRepository
     */
    private $countryRepo;


    /**
     * provinceRepo.  2019/6/10 21:14.
     *
     * @var  \Woisks\AreaBasis\Models\Repository\ChinaProvinceRepository
     */
    private $provinceRepo;
    /**
     * cityRepo.  2019/6/10 21:14.
     *
     * @var  \Woisks\AreaBasis\Models\Repository\ChinaCityRepository
     */
    private $cityRepo;
    /**
     * countyRepo.  2019/6/10 21:14.
     *
     * @var  \Woisks\AreaBasis\Models\Repository\ChinaCountyRepository
     */
    private $countyRepo;
    /**
     * townRepo.  2019/6/10 21:14.
     *
     * @var  \Woisks\AreaBasis\Models\Repository\ChinaTownRepository
     */
    private $townRepo;


    /**
     * AreaService constructor. 2019/7/18 20:32.
     *
     * @param \Woisks\AreaBasis\Models\Repository\CountryRepository       $countryRepo
     * @param \Woisks\AreaBasis\Models\Repository\ChinaProvinceRepository $provinceRepo
     * @param \Woisks\AreaBasis\Models\Repository\ChinaCityRepository     $cityRepo
     * @param \Woisks\AreaBasis\Models\Repository\ChinaCountyRepository   $countyRepo
     * @param \Woisks\AreaBasis\Models\Repository\ChinaTownRepository     $townRepo
     *
     * @return void
     */
    public function __construct(CountryRepository $countryRepo,
                                ChinaProvinceRepository $provinceRepo,
                                ChinaCityRepository $cityRepo,
                                ChinaCountyRepository $countyRepo,
                                ChinaTownRepository $townRepo)
    {
        $this->countryRepo = $countryRepo;
        $this->provinceRepo = $provinceRepo;
        $this->cityRepo = $cityRepo;
        $this->countyRepo = $countyRepo;
        $this->townRepo = $townRepo;
    }


    /**
     * country. 2019/6/10 21:14.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function country()
    {
        $country = $this->countryRepo->get();

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


    public function province()
    {
        $province = $this->provinceRepo->get();

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
     * city. 2019/6/10 21:14.
     *
     * @param $province_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function city($province_id)
    {
        if (strlen($province_id) !== 6 && !is_int($province_id)) {

            return res(422, 'param province id error');
        }

        $collect = $this->cityRepo->get($province_id);

        if ($collect->isEmpty()) {
            return res(404, 'param error province id not exists');
        }

        return res(200, 'success', $collect->toArray());
    }

    /**
     * county. 2019/6/10 21:15.
     *
     * @param $city_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function county($city_id)
    {
        if (strlen($city_id) !== 6 && !is_int($city_id)) {

            return res(422, 'param city id error');
        }

        $collect = $this->countyRepo->get($city_id);

        if ($collect->isEmpty()) {
            return res(404, 'param error city id not exists');
        }

        return res(200, 'success', $collect->toArray());

    }

    /**
     * town. 2019/6/10 21:15.
     *
     * @param $county_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function town($county_id)
    {
        if (strlen($county_id) !== 6 && !is_int($county_id)) {

            return res(422, 'param county id error');
        }

        $collect = $this->townRepo->get($county_id);

        if ($collect->isEmpty()) {
            return res(404, 'param error county id not exists');
        }

        return res(200, 'success', $collect->toArray());

    }
}