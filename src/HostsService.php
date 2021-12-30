<?php


namespace Siam\TestWebServer;


use Siam\HostsManage;

class HostsService
{
    public static function replace($hosts, $new_hosts, $new_ip = null)
    {
        // 判断哪个是nata的
        foreach ($hosts as $domain => $ip){
            if (strpos($domain,"natappfree.cc") !== false){
                if ($new_ip === null) $new_ip = $ip;
                unset($hosts[$domain]);
            }
        }

        $hosts[$new_hosts] = $new_ip;
        return $hosts;
    }

}