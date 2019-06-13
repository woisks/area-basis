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


use Woisks\AreaBasis\Models\Entity\ChinaProvinceEntity;

/**
 * Class ChinaProvinceRepository.
 *
 * @package Woisks\AreaBasis\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 10:28
 */
class ChinaProvinceRepository
{
    /**
     * model.  2019/6/10 10:28.
     *
     * @var static \Woisks\AreaBasis\Models\Entity\ChinaProvinceEntity
     */
    private static $model;

    /**
     * ChinaProvinceRepository constructor. 2019/6/10 10:28.
     *
     * @param \Woisks\AreaBasis\Models\Entity\ChinaProvinceEntity $province
     *
     * @return void
     */
    public function __construct(ChinaProvinceEntity $province)
    {
        self::$model = $province;
    }

    /**
     * get. 2019/6/10 10:28.
     *
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Woisks\AreaBasis\Models\Entity\ChinaProvinceEntity[]
     */
    public function get()
    {
        return self::$model->select('province_id as province', 'short_name as name', 'china_region as region')->get();
    }

    /**
     * exists. 2019/6/10 21:50.
     *
     * @param $province_id
     *
     * @return bool
     */
    public function exists($province_id): bool
    {
        return self::$model->where('province_id', $province_id)->exists();
    }
}