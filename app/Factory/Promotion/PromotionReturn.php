<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-8-11
 * Time: 下午5:37
 */

namespace App\Factory\Promotion;


class PromotionReturn extends PromotionAbstract
{
    /**
     * 定义满多少条件
     * @var int
     */
    protected $condition = 0;

    /**
     * 定义返回条件
     * @var int
     */
    protected $return = 0;

    /**
     * 初始化满减条件
     * PromotionReturn constructor.
     * @param $condition
     * @param $return
     */
    public function __construct($condition,$return)
    {
        $this->condition = $condition;
        $this->return = $return;
    }

    /**
     * 返回满减后的金额
     * @param $total
     */
    public function getTotal($total)
    {
        // TODO: Implement getTotal() method.
        return $this->getReturn($total);
    }

    /**
     * 获取满减金额
     * @param $total
     * @return mixed
     */
    private function getReturn($total){
        $returnTotal = $total;
        if($total>$this->condition){
            $int = $total/$this->condition;
            $returnTotal= $total - floor($int) * $this->return;
        }

        return $returnTotal;
    }
}