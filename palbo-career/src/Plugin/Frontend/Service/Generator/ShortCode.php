<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 21:25
 */

namespace PabloCareer\Plugin\Frontend\Service\Generator;


use PabloCareer\Plugin\Frontend\Service\Generator;
use PabloCareer\Plugin\Struct\ShortCode as ShortCodeStruct;

class ShortCode implements Generator
{

    /**
     * @var array
     */
    private $shortCodes = array();

    /**
     * @param ShortCodeStruct $shortCode
     *
     * @return bool
     */
    public function add(ShortCodeStruct $shortCode)
    {
        if ( ! array_key_exists($shortCode->tag, $this->shortCodes)) {
            $this->shortCodes[$shortCode->tag] = $shortCode;

            return true;
        }

        return false;
    }

    /**
     * @param $tag
     *
     * @return bool
     */
    public function remove($tag)
    {
        if ( ! array_key_exists($tag, $this->shortCodes)) {
            unset( $this->shortCodes[$tag] );

            return true;
        }

        return false;
    }

    /**
     * Generates the shorcuts
     *
     * @param $attributes
     *
     * @return mixed|void
     */
    public function generate($attributes)
    {
        /** @var ShortCodeStruct $shortCode */
        foreach ($this->shortCodes as $shortCode) {
            add_shortcode($shortCode->tag, array($shortCode->object, $shortCode->callback));
        }
    }

}