<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 25.02.16
 * Time: 18:59
 */

namespace PabloCareer\Plugin\Admin\Service\Generator;


use PabloCareer\Plugin\Admin\Handlers\JobForm;
use PabloCareer\Plugin\Admin\Service\Generator;

class Form implements Generator
{


    /**
     * @var \Smarty
     */
    private $smarty;

    /**
     * @var \wpdb
     */
    private $wpdb;

    /**
     * @param \Smarty $smarty
     */
    public function __construct(\Smarty $smarty, \wpdb $wpdb)
    {
        $this->smarty = $smarty;
        $this->wpdb   = $wpdb;
    }

    /**
     * @return mixed
     */
    public function generate()
    {
        $handler = new JobForm($this->wpdb);
        $handler->handle($_REQUEST);

        $this->smarty->assign('item', $handler->getItem());
        $this->smarty->assign('message', $handler->getMsg());
        $this->smarty->assign('notice', $handler->getNotice());

        add_meta_box(
            'jobFormMetaBox',
            __('Job data', 'pablo-career'),
            array(
                $this,
                'generateMetaBox'
            ),
            'job',
            'normal',
            'default'
        );

        $this->smarty->display('admin-job-form.tpl');
    }

    /**
     * @param $item
     */
    public function generateMetaBox($item)
    {
        $this->smarty->assign('item', $item);
        $this->smarty->display('admin-job-metabox.tpl');
    }
}