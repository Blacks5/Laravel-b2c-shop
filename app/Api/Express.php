<?php
namespace App\Api;


class Express
{
    protected $url="http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx";

    public function getExpress($express,$postno)
    {
        $requestData    =   "{'OrderCode':'','ShipperCode':'".$express."','LogisticCode':'".$postno."'}";
        $data  =   array(
            'EBusinessID'   =>  env('EBusinessID'),
            'RequestType'   =>  '1002',
            'RequestData'   =>  urlencode($requestData),
            'DataType'      =>  '2',
        );
        $data['DataSign']  =   $this->encrypt($requestData,env('EBusinessKey'));
        $result     =   $this->sendPost($data);

        return $result;
    }


    /**
     * 电商Sign签名生成
     * @param data 内容
     * @param appkey Appkey
     * @return DataSign签名
     */
    public function encrypt($data,$appKey)
    {
        return urlencode(base64_encode(md5($data.$appKey)));
    }

    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    public function sendPost($data)
    {
        $temps = array();
        foreach ($data as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($this->url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpHeader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpHeader.= "Host:" . $url_info['host'] . "\r\n";
        $httpHeader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpHeader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpHeader.= "Connection:close\r\n\r\n";
        $httpHeader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpHeader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }
}