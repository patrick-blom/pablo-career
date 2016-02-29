<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 25.02.16
 * Time: 18:59
 */

namespace PabloCareer\Plugin\Admin\Service\Generator;


use PabloCareer\Plugin\Admin\Service\Generator;

class Settings implements Generator
{

    /**
     * @var \Smarty
     */
    private $smarty;

    /**
     * @param \Smarty $smarty
     */
    public function __construct(\Smarty $smarty)
    {
        $this->smarty = $smarty;
    }

    /**
     * @return mixed
     */
    public function generate()
    {
        settings_fields( 'general' );

        $this->smarty->assign( 'single_page_id', get_option( 'pablo_single_page', false ) );
        $this->smarty->display( 'admin-settings.tpl' );
    }
}