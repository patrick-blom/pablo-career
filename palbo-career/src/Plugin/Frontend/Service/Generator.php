<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 21:44
 */

namespace PabloCareer\Plugin\Frontend\Service;


interface Generator
{
    /**
     * @param $attributes
     *
     * @return mixed
     */
    public function generate($attributes);
}