<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-8-11
 * Time: 下午5:50
 */

namespace App\Factory\Promotion;


class PromotionPostage extends PromotionAbstract
{
    /**
     * 定义包邮金额
     * @var int
     */
    private $condition = 0;

    /**
     * 定义邮费
     * @var int
     */
    private $postage = 10;

    /**
     * 初始化包邮金额和邮费
     * PromotionPostage constructor.
     * @param $condition
     * @param $postage
     */
    public function __construct($condition,$postage)
    {
        $this->condition = $condition;
        $this->postage = $postage;
    }

    /**
     * 返回金额
     * @param $total
     * @return mixed
     */
    public function getTotal($total)
    {
        // TODO: Implement getTotal() method.
        return $this->getPostage($total);
    }

    /**
     * 获取金额
     * @param $total
     * @return mixed
     */
    private function getPostage($total){
        $getPostage = $total;
        if($total>$this->condition){
            $getPostage = $total - $this->postage;
        }

        return $getPostage;
    }
}