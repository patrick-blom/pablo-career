<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 20:54
 */

namespace PabloCareer\Plugin\Helper\Template;


class WordpressSmartyProxy
{
    /**
     * Simple template proxy to handle functions like _e() or get_header
     *
     * @param $function
     * @param $arguments
     *
     * @return mixed|null
     * @throws \Exception
     */
    public function __call($function, $arguments)
    {
        if ( ! function_exists($function)) {
            throw new \Exception("{$function} not exists");
        }

        return call_user_func_array($function, $arguments);
    }

    /**
     * Simple template proxy to handle functions like _e() or get_header
     *
     * @param $function
     * @param $arguments
     *
     * @return mixed|null
     * @throws \Exception
     */
    public static function __callStatic($function, $arguments)
    {
        if ( ! function_exists($function)) {
            throw new \Exception("{$function} not exists");

        }

        return call_user_func_array($function, $arguments);
    }
}