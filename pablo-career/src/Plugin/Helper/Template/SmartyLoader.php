<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 20:45
 */

namespace PabloCareer\Plugin\Helper\Template;

use PabloCareer\Plugin\Frontend\ViewRenderer;
use PabloCareer\Plugin\Struct\SmartyConfig;

class SmartyLoader
{

    /**
     * @var \Smarty
     */
    private $smarty;

    /**
     * @var SmartyConfig
     */
    private $smartyConfig;

    /**
     * @var ViewRenderer
     */
    private $viewRenderer;

    /**
     * @param \Smarty $smarty
     * @param SmartyConfig $smartyConfig
     */
    public function __construct(\Smarty $smarty, SmartyConfig $smartyConfig, ViewRenderer $viewRenderer)
    {
        $this->smarty       = $smarty;
        $this->smartyConfig = $smartyConfig;
        $this->viewRenderer = $viewRenderer;
    }

    /**
     * Inits the plugin specific config and add the proxt
     */
    public function init()
    {
        $this->smarty->setTemplateDir($this->smartyConfig->templateDir);
        $this->smarty->setCompileDir($this->smartyConfig->compileDir);
        $this->smarty->setCacheDir($this->smartyConfig->cacheDir);
        $this->smarty->setConfigDir($this->smartyConfig->configDir);

        $this->smarty->setDebugging($this->smartyConfig->debugging);
        $this->smarty->setCaching($this->smartyConfig->caching);

        $this->smarty->registerClass("WPP", "PabloCareer\\Plugin\\Helper\\Template\\WordpressSmartyProxy");

        $this->smarty->registerPlugin("function", "getSortUrl", array($this->viewRenderer, "getSortUrl"));
        $this->smarty->registerPlugin("function", "getSingleJobUrl", array($this->viewRenderer, "getSingleJobUrl"));
        $this->smarty->registerPlugin("function", "getBackLink", array($this->viewRenderer, "getBackLink"));

    }

}