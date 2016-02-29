<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 21:02
 */

namespace PabloCareer\Plugin\Localisation;


class TextDomainLoader
{

    /**
     * @var string
     */
    private $textdomain = "pablo-career";

    /**
     * @var string
     */
    private $path;

    /**
     * @param $path
     */
    public function __construct($path)
    {
       $this->path = $path;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function load()
    {
        if ( ! $this->path) {
            throw new \Exception('Path to text domain not specified');
        }

        return load_plugin_textdomain($this->textdomain, false, $this->path);
    }
}