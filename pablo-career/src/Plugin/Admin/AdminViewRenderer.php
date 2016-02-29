<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 25.02.16
 * Time: 17:13
 */

namespace PabloCareer\Plugin\Admin;


use PabloCareer\Plugin\Admin\Service\Generator\Form;
use PabloCareer\Plugin\Admin\Service\Generator\JobList;
use PabloCareer\Plugin\Admin\Service\Generator\Page;
use PabloCareer\Plugin\Admin\Service\Generator\Settings;
use PabloCareer\Plugin\Struct\MenuEntry;
use PabloCareer\Plugin\Struct\OptionsMenuEntry;
use PabloCareer\Plugin\Struct\SubMenuEntry;
use PabloCareer\Plugin\Struct\WordpressConfig;

class AdminViewRenderer
{

    /**
     * @var \Smarty
     */
    private $smarty;


    /**
     * @var WordpressConfig
     */
    private $wordpressConfig;

    /**
     * @param \Smarty $smarty
     * @param WordpressConfig $wordpressConfig
     */
    public function __construct(\Smarty $smarty, WordpressConfig $wordpressConfig)
    {
        $this->smarty          = $smarty;
        $this->wordpressConfig = $wordpressConfig;
    }

    /**
     * Renders my view
     */
    public function render()
    {
        $pageGenerator = new Page();

        $pageGenerator->add(
            new MenuEntry(
                array(
                    "pageTitle"  => __('Job Offers', 'pablo-career'),
                    "menuTitle"  => __('Job Offers', 'pablo-career'),
                    "capability" => "activate_plugins",
                    "slug"       => "jobs",
                    "object"     => new JobList($this->smarty),
                    "callback"   => "generate",
                    "icon"       => "dashicons-id-alt",
                    "position"    => 40
                )
            ),
            'menu'
        );

        $pageGenerator->add(
            new SubMenuEntry(
                array(
                    "parent"     => "jobs",
                    "pageTitle"  => __('Add Job Offer', 'pablo-career'),
                    "menuTitle"  => __('Add Job Offer', 'pablo-career'),
                    "capability" => "activate_plugins",
                    "slug"       => "job_form",
                    "object"     => new Form($this->smarty, $this->wordpressConfig->wpDb),
                    "callback"   => "generate"
                )
            ),
            'subMenu'
        );

        $pageGenerator->add(
            new OptionsMenuEntry(
                array(
                    "pageTitle"  => __('Job Offer Settings', 'pablo-career'),
                    "menuTitle"  => __('Job Offer Settings', 'pablo-career'),
                    "capability" => "manage_options",
                    "slug"       => "job-offer-settings",
                    "object"     => new Settings($this->smarty),
                    "callback"   => "generate"
                )
            ),
            'option'
        );

        $pageGenerator->generate();
    }

    /**
     * register settings and options
     */
    public function registerOptions()
    {
        register_setting('general', 'pablo_single_page');
    }
}