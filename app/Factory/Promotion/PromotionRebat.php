<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-8-11
 * Time: 下午5:28
 */

namespace App\Factory\Promotion;


class PromotionRebat extends PromotionAbstract
{
    public $rebat=1;

    /**
     * 初始化时获取打折的折率
     * PromotionRebat constructor.
     * @param $rebat
     */
    public function __construct($rebat)
    {
        $this->rebat = $rebat;
    }

    /**
     * 返回打折后的总价
     * @param $total
     * @return mixed
     */
    public function getTotal($total)
    {
        // TODO: Implement getTotal() method.
        return $total*$this->rebat;
    }
}