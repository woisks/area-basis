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


use Woisks\AreaBasis\Models\Entity\ChinaCityEntity;
use Woisks\AreaBasis\Models\Entity\ChinaCountyEntity;
use Woisks\AreaBasis\Models\Entity\ChinaProvinceEntity;
use Woisks\AreaBasis\Models\Entity\ChinaTownEntity;
use Woisks\AreaBasis\Models\Entity\CountryEntity;

class AreaServices
{
    /**
     * exists. 2019/7/31 21:27.
     *
     * @param $table
     * @param $id
     *
     * @return bool
     */
    public static function exists($table, $id)
    {
        switch ($table) {
            case 'country':
                return CountryEntity::where('id', $id)->exists();
                break;
            case 'province':
                return ChinaProvinceEntity::where('province_id', $id)->exists();
                break;
            case 'city':
                return ChinaCityEntity::where('city_id', $id)->exists();
                break;
            case 'county':
                return ChinaCountyEntity::where('county_id', $id)->exists();
                break;
            case 'town':
                return ChinaTownEntity::where('town_id', $id)->exists();
                break;
            default:
                return false;
        }


    }

    /**
     * first. 2019/7/31 21:03.
     *
     * @param $table
     * @param $id
     *
     * @return mixed
     */
    public static function first($table, $id)
    {
        switch ($table) {
            case 'country':
                return CountryEntity::where('id', $id)->first();
                break;
            case 'province':
                return ChinaProvinceEntity::where('province_id', $id)->first();
                break;
            case 'city':
                return ChinaCityEntity::where('city_id', $id)->first();
                break;
            case 'county':
                return ChinaCountyEntity::where('county_id', $id)->first();
                break;
            case 'town':
                return ChinaTownEntity::where('town_id', $id)->first();
                break;
            default:
                return false;
        }

    }

    public static function cascade($country, $province, $city, $county, $town)
    {

        if ($country != 1) {
            //验证是不是中国
            $db = self::first('country', $country);
            if ($db) {

                return ['country'     => $db->cn_name,
                        'country_id'  => $db->id,
                        'province'    => '',
                        'province_id' => 0,
                        'city'        => '',
                        'city_id'     => 0,
                        'county'      => '',
                        'county_id'   => 0,
                        'town'        => '',
                        'town_id'     => 0
                ];
            }
            return null;
        }

        //验证节点
        $node = [];

        if ($province && self::exists('province', $province)) {

            $node['id']    = $province;
            $node['table'] = 'province';
        }

        if ($city && self::exists('city', $city)) {

            $node['id']    = $city;
            $node['table'] = 'city';
        }

        if ($county && self::exists('county', $county)) {

            $node['id']    = $county;
            $node['table'] = 'county';
        }

        if ($town && self::exists('town', $town)) {

            $node['id']    = $town;
            $node['table'] = 'town';
        }


        if (empty($node)) {
            //如果为空直接返回中国
            return [
                'country'     => '中国',
                'country_id'  => 1,
                'province'    => '',
                'province_id' => 0,
                'city'        => '',
                'city_id'     => 0,
                'county'      => '',
                'county_id'   => 0,
                'town'        => '',
                'town_id'     => 0
            ];
        }

        return self::serivces($node['table'], $node['id']);
    }

    private static function serivces($table, $id)
    {
        switch ($table) {
            case 'town':
                $town     = self::first('town', $id)->town_id;
                $county   = self::first('county', $town->county_id);
                $city     = self::first('city', $county->city_id);
                $province = self::first('province', $city->province_id);
                dd($county);
                return ['country'     => '中国',
                        'country_id'  => 1,
                        'province'    => $province->short_name,
                        'province_id' => $province->province_id,
                        'city'        => $city->short_name,
                        'city_id'     => $city->city_id,
                        'county'      => $county->short_name,
                        'county_id'   => $county->county_id,
                        'town'        => $town->short_name,
                        'town_id'     => $town->town_id
                ];
                break;

//            case 'city':
//                return self::city($node['id']);
//                break;
//
//            case 'county':
//                list($country, $province, $city, $county) = explode(',', $node['model']->merger_name);
//                return ['country' => $country, 'province' => $province, 'city' => $city, 'county' => $county, 'town' => ''];
//                break;
//
//            case 'town':
//                list($country, $province, $city, $county, $town) = explode(',', $node['model']->merger_name);
//                return ['country' => $country, 'province' => $province, 'city' => $city, 'county' => $county, 'town' => $town];
//                break;

            default:
                return null;
        }
    }


    private static function province($id)
    {
        $db = self::first('province', $id);
        if ($db) {
            return ['country'     => '中国',
                    'country_id'  => 1,
                    'province'    => $db->short_name,
                    'province_id' => $db->province_id,
                    'city'        => '',
                    'city_id'     => 0,
                    'county'      => '',
                    'county_id'   => 0,
                    'town'        => '',
                    'town_id'     => 0
            ];
        }

        return ['country'     => '中国',
                'country_id'  => 1,
                'province'    => '',
                'province_id' => 0,
                'city'        => '',
                'city_id'     => 0,
                'county'      => '',
                'county_id'   => 0,
                'town'        => '',
                'town_id'     => 0
        ];
    }

    private static function city($id)
    {
        $db = self::first('city', $id);
        if ($db) {
            $province_db = self::first('province', $db->province_id);
            return ['country'     => '中国',
                    'country_id'  => 1,
                    'province'    => $province_db->short_name,
                    'province_id' => $db->province_id,
                    'city'        => $db->short_name,
                    'city_id'     => $db->city_id,
                    'county'      => '',
                    'county_id'   => 0,
                    'town'        => '',
                    'town_id'     => 0
            ];
        }

        return ['country'     => '中国',
                'country_id'  => 1,
                'province'    => '',
                'province_id' => 0,
                'city'        => '',
                'city_id'     => 0,
                'county'      => '',
                'county_id'   => 0,
                'town'        => '',
                'town_id'     => 0
        ];
    }

}
