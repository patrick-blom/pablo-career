<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 22:00
 */

namespace PabloCareer\Plugin\Struct;


class WordpressConfig extends Struct
{
    /**
     * @var \wpdb
     */
    public $wpDb;

    /**
     * @var \WP
     */
    public $wp;

    /**
     * @var \WP_Query
     */
    public $wpQuery;
}