<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 20:22
 */

namespace PabloCareer\Plugin\Struct;


class Struct
{
    /**
     * @param array $properties
     */
    public function __construct($properties = array())
    {
        if ( ! empty( $properties )) {
            foreach ($properties as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @param $property
     *
     * @throws \Exception
     */
    public function __get($property)
    {
        throw new \Exception('Trying to get non-existing property ' . $property);
    }

    /**
     * @param $property
     * @param $value
     *
     * @throws \Exception
     */
    public function __set($property, $value)
    {
        throw new \Exception('Trying to set non-existing property ' . $property);
    }

    /**
     * Clones the struct
     */
    public function __clone()
    {
        foreach ($this as $property => $value) {
            if (is_object($value)) {
                $this->$property = clone $value;
            }
        }
    }
}