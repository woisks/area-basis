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

namespace Woisks\AreaBasis\Models\Repository;


use Woisks\AreaBasis\Models\Entity\ChinaCityEntity;

/**
 * Class ChinaCityRepository.
 *
 * @package Woisks\AreaBasis\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 10:59
 */
class ChinaCityRepository
{
    /**
     * model.  2019/6/10 10:59.
     *
     * @var static \Woisks\AreaBasis\Models\Entity\ChinaCityEntity
     */
    private static $model;

    /**
     * ChinaCityRepository constructor. 2019/6/10 10:59.
     *
     * @param \Woisks\AreaBasis\Models\Entity\ChinaCityEntity $city
     *
     * @return void
     */
    public function __construct(ChinaCityEntity $city)
    {
        self::$model = $city;
    }

    /**
     * get. 2019/6/10 10:59.
     *
     * @param $province_id
     *
     * @return \Illuminate\Support\Collection|[]
     */
    public function get($province_id)
    {
        return self::$model->where('province_id', $province_id)->select('city_id as city', 'short_name as name')->get();
    }

    /**
     * exists. 2019/6/10 21:48.
     *
     * @param $city_id
     *
     * @return bool
     */
    public function exists($city_id): bool
    {
        return self::$model->where('city_id', $city_id)->exists();
    }

}