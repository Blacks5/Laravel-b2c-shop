<?php
namespace App\Translate;


use function MongoDB\BSON\toJSON;
use function PHPSTORM_META\type;

class Translate
{
    protected $url  =   "https://openapi.youdao.com/api";

    public function toTranslate($query){
        $appKey     =   "467139bc9c0ef35a";
        $secretKey  =   "8wFDRokPoWzLv4qxGdKoN7SxibZq8U2E";
        $form       =   "zh-CHS";
        $to         =   "EN";
        $salt       =   random_int(1,9);
        $sign       =   $this->sign($appKey,$query,$salt,$secretKey);

        $data   =   [
            'appKey'    => $appKey,
            'q'         => $query,
            'form'      => $form,
            'to'        => $to,
            'salt'      => $salt,
            'sign'      => $sign,
        ];
        $sendData   =   http_build_query($data);
        $options = [
            'http' => [
                'method'  => 'GET',
                'header'  => 'Content-Type: application/json;charset=UTF-8',
                'content' => $sendData
            ]];
        $context    =   stream_context_create($options);
        return json_decode(file_get_contents($this->url.'?'.$sendData));

    }

    protected function sign($appKey,$query,$salt,$secretKey){
        return md5($appKey.$query.$salt.$secretKey);
    }
}

