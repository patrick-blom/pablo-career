<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 23:14
 */

namespace PabloCareer\Plugin\Helper\StlyeScript;


class Loader
{
    /**
     * @var string
     */
    private $pluginName;

    /**
     * @var string
     */
    private $version;

    /**
     * @param $pluginName
     * @param $version
     */
    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version    = $version;
    }

    /**
     * load frontend and backend styles
     */
    public function loadFrontStyles()
    {
        wp_enqueue_style(
            $this->pluginName,
            dirname(plugin_dir_url(__FILE__)).'/../../../public/css/teaw-career-public.css',
            array(),
            $this->version,
            'all'
        );
        wp_enqueue_style(
            $this->pluginName.'-icons',
            dirname(plugin_dir_url(__FILE__)).'/../../../public/css/dashicons.min.css',
            array(),
            $this->version,
            'all'
        );
    }

    /**
     * load frontend and backend scripts
     */
    public function loadFrontScripts()
    {
        wp_enqueue_script(
            $this->pluginName,
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
            array('jquery'),
            $this->version, false
        );
    }

}