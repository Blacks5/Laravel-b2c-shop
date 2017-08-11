<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-8-11
 * Time: 下午5:07
 */

namespace App\Factory\Promotion;


abstract class PromotionAbstract
{
    /**
     * 定义抽象总价
     * @param $total
     * @return mixed
     */
    abstract function getTotal($total);
}