<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 20:34
 */

namespace PabloCareer\Plugin\Struct;


class SmartyConfig extends Struct
{
    /**
     * @var mixed
     */
    public $templateDir;

    /**
     * @var string
     */
    public $compileDir;

    /**
     * @var string
     */
    public $cacheDir;

    /**
     * @var string
     */
    public $configDir;

    /**
     * @var boolean
     */
    public $debugging;

    /**
     * @var boolean
     */
    public $caching;
}