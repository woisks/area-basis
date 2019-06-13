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


use Woisks\AreaBasis\Models\Entity\ChinaTownEntity;

/**
 * Class ChinaTownRepository.
 *
 * @package Woisks\AreaBasis\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 21:51
 */
class ChinaTownRepository
{

    /**
     * model.  2019/6/10 21:51.
     *
     * @var static \Woisks\AreaBasis\Models\Entity\ChinaTownEntity
     */
    private static $model;


    /**
     * ChinaTownRepository constructor. 2019/6/10 21:51.
     *
     * @param \Woisks\AreaBasis\Models\Entity\ChinaTownEntity $town
     *
     * @return void
     */
    public function __construct(ChinaTownEntity $town)
    {
        self::$model = $town;
    }

    /**
     * get. 2019/6/10 20:51.
     *
     * @param $county_id
     *
     * @return mixed
     */
    public function get($county_id)
    {
        return self::$model->where('county_id', $county_id)->select('town_id as town', 'town as name')->get();
    }

    /**
     * exists. 2019/6/10 21:51.
     *
     * @param $town_id
     *
     * @return bool
     */
    public function exists($town_id)
    {
        return self::$model->where('town_id', $town_id)->exists();
    }

}