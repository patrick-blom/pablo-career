<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 25.02.16
 * Time: 18:58
 */

namespace PabloCareer\Plugin\Admin\Service\Generator;


use PabloCareer\Plugin\Admin\Service\Generator;

class JobList implements Generator
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
        $this->smarty->assign("joblist", new \PabloCareer\Plugin\Admin\Service\JobList());
        $this->smarty->display('admin-joblist.tpl');
    }
}