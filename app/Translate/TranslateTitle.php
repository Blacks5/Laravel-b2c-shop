<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-8-1
 * Time: 下午3:45
 */

namespace App\Translate;


use App\Article;
use Carbon\Carbon;

class TranslateTitle extends Translate
{
    public function translateTitle($query){
        $title    =   $this->toTranslate($query);
        $newTitle   = str_replace(' ','-',$title->translation);
        if(empty($newTitle)){
            $newTitle   =   $query;
        }
            $newTitle[0]=date('Y-m-d').'-'.$newTitle[0].'-'.str_random(4);

        return $newTitle[0];
    }
}