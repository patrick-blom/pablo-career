<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 21:20
 */

namespace PabloCareer\Plugin;


use PabloCareer\Plugin\Admin\AdminViewRenderer;
use PabloCareer\Plugin\Frontend\ViewRenderer;
use PabloCareer\Plugin\Helper\StlyeScript\Loader as StlyeScriptLoader;
use PabloCareer\Plugin\Helper\Template\SmartyLoader;
use PabloCareer\Plugin\Localisation\TextDomainLoader;
use PabloCareer\Plugin\Struct\SmartyConfig;
use PabloCareer\Plugin\Struct\WordpressConfig;

class PabloCareer
{

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @var \Smarty
     */
    private $smarty;

    /**
     * @var WordpressConfig
     */
    private $wordpressConfig;

    /**
     * @var ViewRenderer
     */
    private $viewRenderer;

    /**
     * @var AdminViewRenderer
     */
    private $adminViewRenderer;

    /**
     * Init function
     */
    public function init()
    {
        $this->loader = new Loader();

        $this->initLocalisation();
        $this->initWPConfig();
        $this->initSmarty();
        $this->initStylesAndScripts();
        $this->initFrontend();
        $this->initAdmin();
    }

    /**
     * Runs the loader
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * Init text domain
     */
    private function initLocalisation()
    {
        $this->loader->add_action(
            'plugins_loaded',
            new TextDomainLoader(dirname(dirname(plugin_basename(__FILE__))) . '/../languages/'),
            'load'
        );
    }

    /**
     * Init the Wordpress globals
     */
    private function initWPConfig()
    {
        global $wp, $wpdb, $wp_query;

        $this->wordpressConfig = new WordpressConfig(
            array(
                "wpDb"    => $wpdb,
                "wp"      => $wp,
                "wpQuery" => $wp_query
            )
        );
    }

    /**
     * Init Smarty
     */
    private function initSmarty()
    {
        $this->smarty = new \Smarty();
        $smartyConfig = new SmartyConfig(
            array(
                "templateDir" => array(
                    plugin_dir_path(__FILE__) . '/../../smarty/templates/public',
                    plugin_dir_path(__FILE__) . '/../../smarty/templates/admin',
                ),
                "configDir"   => plugin_dir_path(__FILE__) . '/../../smarty/configs',
                "compileDir"  => plugin_dir_path(__FILE__) . '/../../tmp/templates_c',
                "cacheDir"    => plugin_dir_path(__FILE__) . '/../../tmp/cache',
                "debugging"   => false,
                "caching"     => false,

            )
        );

        $this->viewRenderer = new ViewRenderer($this->smarty, $this->wordpressConfig);

        $smartyLoader = new SmartyLoader($this->smarty, $smartyConfig, $this->viewRenderer);
        $smartyLoader->init();
    }

    /**
     * Init the styles and scripts
     */
    private function initStylesAndScripts()
    {
        $helper = new StlyeScriptLoader('pablo-career', '1.0.3');

        $this->loader->add_action( 'wp_enqueue_scripts', $helper, 'loadFrontStyles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $helper, 'loadFrontScripts' );
    }

    /**
     * Init the admin part of the  plugin
     */
    private function initAdmin()
    {
        $this->adminViewRenderer = new AdminViewRenderer($this->smarty, $this->wordpressConfig);
        $this->loader->add_action( 'admin_menu', $this->adminViewRenderer, 'render' );
        $this->loader->add_action( 'admin_init', $this->adminViewRenderer, 'registerOptions' );
    }

    /**
     * Init the frontend part of the plugin
     */
    private function initFrontend()
    {
        $this->viewRenderer->render();
        $this->loader->add_action('template_redirect', $this->viewRenderer, 'jobRedirect');
    }

}