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


use Woisks\AreaBasis\Models\Entity\ChinaCountyEntity;

/**
 * Class ChinaCountyRepository.
 *
 * @package Woisks\AreaBasis\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 20:51
 */
class ChinaCountyRepository
{
    /**
     * model.  2019/6/10 20:51.
     *
     * @var static \Woisks\AreaBasis\Models\Entity\ChinaCountyEntity
     */
    private static $model;

    /**
     * ChinaCountyRepository constructor. 2019/6/10 20:51.
     *
     * @param \Woisks\AreaBasis\Models\Entity\ChinaCountyEntity $county
     *
     * @return void
     */
    public function __construct(ChinaCountyEntity $county)
    {
        self::$model = $county;
    }

    /**
     * get. 2019/6/10 20:51.
     *
     * @param $city_id
     *
     * @return mixed
     */
    public function get($city_id)
    {
        return self::$model->where('city_id', $city_id)->select('county_id as county', 'short_name as name')->get();
    }

    /**
     * exists. 2019/6/10 21:48.
     *
     * @param $county_id
     *
     * @return bool
     */
    public function exists($county_id): bool
    {
        return self::$model->where('county_id', $county_id)->exists();
    }

}