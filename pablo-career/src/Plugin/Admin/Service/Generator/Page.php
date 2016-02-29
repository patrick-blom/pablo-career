<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 25.02.16
 * Time: 20:14
 */

namespace PabloCareer\Plugin\Admin\Service\Generator;

use PabloCareer\Plugin\Admin\Service\Generator;
use PabloCareer\Plugin\Struct\OptionsMenuEntry;
use PabloCareer\Plugin\Struct\MenuEntry;
use PabloCareer\Plugin\Struct\SubMenuEntry;

class Page implements Generator
{

    /**
     * @var array
     */
    private $menu = array();

    /**
     * @var array
     */
    private $subMenu = array();

    /**
     * @var array
     */
    private $option = array();

    /**
     * @param $page
     * @param $type
     *
     * @return bool
     * @throws \Exception
     */
    public function add($page, $type)
    {
        if ( ! array_key_exists($type, get_class_vars(get_class($this)))) {
            throw new \Exception('Page type not defined');
        }

        array_push($this->$type, $page);

        return true;
    }

    /**
     * @return mixed
     */
    public function generate()
    {
        foreach (array_keys(get_class_vars(get_class($this))) as $type) {
            $methodName = 'generate' . ucfirst($type);
            $this->$methodName();
        }
    }

    /**
     * Generates menu a page
     */
    private function generateMenu()
    {
        /** @var MenuEntry $menu */
        foreach ($this->menu as $menu) {
            add_menu_page(
                $menu->pageTitle,
                $menu->menuTitle,
                $menu->capability,
                $menu->slug,
                array(
                    $menu->object,
                    $menu->callback
                ),
                $menu->icon,
                $menu->position
            );
        }
    }

    /**
     * Generates sub menu a page
     */
    private function generateSubMenu()
    {
        /** @var SubMenuEntry $subMenu */
        foreach ($this->subMenu as $subMenu) {
            add_submenu_page(
                $subMenu->parent,
                $subMenu->pageTitle,
                $subMenu->menuTitle,
                $subMenu->capability,
                $subMenu->slug,
                array(
                    $subMenu->object,
                    $subMenu->callback
                )
            );
        }
    }

    /**
     * Generates options menu a page
     */
    private function generateOption()
    {
        /** @var OptionsMenuEntry $option */
        foreach ($this->option as $option) {
            add_options_page(
                $option->pageTitle,
                $option->menuTitle,
                $option->capability,
                $option->slug,
                array(
                    $option->object,
                    $option->callback
                )
            );
        }
    }
}