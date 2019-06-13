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


use Woisks\AreaBasis\Models\Entity\CountryEntity;

/**
 * Class CountryRepository.
 *
 * @package Woisks\AreaBasis\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/6/10 10:19
 */
class CountryRepository
{
    /**
     * model.  2019/6/10 10:19.
     *
     * @var static \Woisks\AreaBasis\Models\Entity\CountryEntity
     */
    private static $model;

    /**
     * CountryRepository constructor. 2019/6/10 10:19.
     *
     * @param \Woisks\AreaBasis\Models\Entity\CountryEntity $country
     *
     * @return void
     */
    public function __construct(CountryEntity $country)
    {
        self::$model = $country;
    }

    /**
     * get. 2019/6/10 10:20.
     *
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Woisks\AreaBasis\Models\Entity\CountryEntity[]
     */
    public function get()
    {
        return self::$model->all();
    }

    /**
     * exists. 2019/6/10 21:51.
     *
     * @param $country_id
     *
     * @return bool
     */
    public function exists($country_id): bool
    {
        return self::$model->where('id', $country_id)->exists();
    }

}