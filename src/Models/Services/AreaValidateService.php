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
 * Class AreaValidateService.
 *
 * @package Woisks\AreaBasis\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 21:45
 */
class AreaValidateService
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
     * AreaValidateService constructor. 2019/6/10 21:44.
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
                                ChinaTownRepository $townRepo
    )
    {
        $this->countryRepo = $countryRepo;
        $this->provinceRepo = $provinceRepo;
        $this->cityRepo = $cityRepo;
        $this->countyRepo = $countyRepo;
        $this->townRepo = $townRepo;

    }

    /**
     * validate. 2019/6/10 22:44.
     *
     * @param string $validate_table
     * @param int    $validate_id
     *
     * @return bool
     */
    public static function validate(string $validate_table, int $validate_id)
    {
        return app(AreaValidateService::class)->services($validate_table, $validate_id);
    }


    /**
     * services. 2019/6/10 22:44.
     *
     * @param string $validate_table
     * @param int    $validate_id
     *
     * @return bool
     */
    private function services(string $validate_table, int $validate_id)
    {
        switch ($validate_table) {
            case 'country':
                $bool = $this->country($validate_id);
                break;
            case 'province':
                $bool = $this->province($validate_id);
                break;
            case 'city':
                $bool = $this->city($validate_id);
                break;
            case 'county':
                $bool = $this->county($validate_id);
                break;
            case 'town':
                $bool = $this->town($validate_id);
                break;
            default:
                $bool = false;
        }

        return $bool;

    }

    /**
     * country. 2019/6/10 22:44.
     *
     * @param int $country_id
     *
     * @return bool
     */
    private function country(int $country_id)
    {
        return $this->countryRepo->exists($country_id);
    }

    /**
     * province. 2019/6/10 22:44.
     *
     * @param int $province_id
     *
     * @return bool
     */
    private function province(int $province_id)
    {
        return $this->provinceRepo->exists($province_id);
    }

    /**
     * city. 2019/6/10 22:44.
     *
     * @param int $city_id
     *
     * @return bool
     */
    private function city(int $city_id)
    {
        return $this->cityRepo->exists($city_id);
    }

    /**
     * county. 2019/6/10 22:44.
     *
     * @param int $county_id
     *
     * @return bool
     */
    private function county(int $county_id)
    {
        return $this->countyRepo->exists($county_id);
    }

    /**
     * town. 2019/6/10 22:44.
     *
     * @param int $town_id
     *
     * @return bool
     */
    private function town(int $town_id)
    {
        return $this->townRepo->exists($town_id);
    }
}