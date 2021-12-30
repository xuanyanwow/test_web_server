<?php


namespace Siam\TestWebServer;


class NatappHelperService
{
    /**
     * 抓取新的natapp域名
     */
    public static function get_hosts()
    {
        // 从http://127.0.0.1:4040 抓取新的natappfree域名 放进去
        try {
            $curl = \Siam\Curl::getInstance()->send("http://127.0.0.1:4040/http/in", null, [], false);
        } catch (\Exception $e) {
            echo "获取新natapp域名失败，请检查natapp服务是否开启\n";
            echo $e->getMessage();
            die();
        }

        $need = self::getNeedBetween('http://', '.cc', $curl);
        $need .= ".cc";
        return $need;
    }


    public static function getNeedBetween($begin, $end,$str){
        $b = mb_strpos($str,$begin) + mb_strlen($begin);
        $e = mb_strpos($str,$end) - $b;
        return mb_substr($str,$b,$e);
    }
}