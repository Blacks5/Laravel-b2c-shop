<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-8-11
 * Time: 下午5:25
 */

namespace App\Factory\Promotion;


class PromotionNormal extends PromotionAbstract
{
    /**
     * 返回原价
     * @param $total
     * @return mixed
     */
    public function getTotal($total)
    {
        // TODO: Implement getTotal() method.
        return $total;
    }
}