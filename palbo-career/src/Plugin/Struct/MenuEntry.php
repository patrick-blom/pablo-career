<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 25.02.16
 * Time: 18:51
 */

namespace PabloCareer\Plugin\Struct;


class MenuEntry extends Struct
{

    /**
     * @var string
     */
    public $pageTitle = "";

    /**
     * @var string
     */
    public $menuTitle = "";

    /**
     * @var string
     */
    public $capability = "";

    /**
     * @var string
     */
    public $slug = "";

    /**
     * @var mixed
     */
    public $object = null;

    /**
     * @var string
     */
    public $callback = "";

    /**
     * @var string
     */
    public $icon = "";

    /**
     * @var null
     */
    public $position = null;

}