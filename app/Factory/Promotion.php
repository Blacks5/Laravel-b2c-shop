<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-8-11
 * Time: 下午6:07
 */

namespace App\Factory;


use App\Factory\Promotion\PromotionNormal;
use App\Factory\Promotion\PromotionPostage;
use App\Factory\Promotion\PromotionRebat;
use App\Factory\Promotion\PromotionReturn;

trait Promotion
{
    /**
     * 定义实例化对象
     * @var promotion
     */
    private $promotion;

    /**
     * 根据type选择策略实例化
     * @param $promotion
     */
    private function getPromotion($promotion){
        switch ($promotion['type']){
            case '原价':
                $this->promotion =new PromotionNormal();
                break;
            case '折扣':
                $this->promotion = new PromotionRebat($promotion['rebat']);
                break;
            case '满减':
                $this->promotion = new PromotionReturn($promotion['condition'],$promotion['return']);
                break;
            case '包邮':
                $this->promotion = new PromotionPostage($promotion['condition'],$promotion['postage']);
                break;
        }

    }

    /**
     * 通过实例化的策略获得价格
     * @param $promotion
     * @return Promotion
     */
    public function getTotal($promotion){
        if(!isset($this->promotion)){
            $this->getPromotion($promotion);
        }

        return $this->promotion->getTotal($promotion['total']);
    }
}