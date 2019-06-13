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


use Woisks\AreaBasis\Models\Entity\ChinaRegionEntity;

/**
 * Class ChinaRegionRepository.
 *
 * @package Woisks\AreaBasis\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 21:02
 */
class ChinaRegionRepository
{
    /**
     * model.  2019/6/10 21:02.
     *
     * @var static \Woisks\AreaBasis\Models\Entity\ChinaRegionEntity
     */
    private static $model;

    /**
     * ChinaRegionRepository constructor. 2019/6/10 21:02.
     *
     * @param \Woisks\AreaBasis\Models\Entity\ChinaRegionEntity $region
     *
     * @return void
     */
    public function __construct(ChinaRegionEntity $region)
    {
        self::$model = $region;
    }

    /**
     * get. 2019/6/10 21:02.
     *
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Woisks\AreaBasis\Models\Entity\ChinaRegionEntity[]
     */
    public function get()
    {
        return self::$model->all();
    }

}