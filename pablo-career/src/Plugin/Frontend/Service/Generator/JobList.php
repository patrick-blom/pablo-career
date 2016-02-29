<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 21:42
 */

namespace PabloCareer\Plugin\Frontend\Service\Generator;


use PabloCareer\Plugin\Frontend\Service\Generator;
use PabloCareer\Plugin\Struct\WordpressConfig;

class JobList implements Generator
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
     * @param $attributes
     *
     * @return mixed
     */
    public function generate($attributes)
    {
        $attributes = shortcode_atts(array(
            'lang' => 'de'
        ), $attributes);

        $data = array(
            'orderby' => get_query_var('orderby', 'title'),
            'order'   => get_query_var('order', 'ASC')
        );

        $sql = "SELECT * FROM {$this->wordpressConfig->wpDb->prefix}pablo_career_jobs
                WHERE active='1'
                AND languageid ='" . esc_sql($attributes['lang']) . "' ";

        if ( ! empty( $data['orderby'] )) {
            $sql .= ' ORDER BY ' . esc_sql($data['orderby']);
            $sql .= ! empty( $data['order'] ) ? ' ' . esc_sql($data['order']) : ' ACS';
        }

        $joblist = $this->wordpressConfig->wpDb->get_results($sql, 'ARRAY_A');

        $this->smarty->assign('joblist', $joblist);
        $this->smarty->display('joblist.tpl');
    }
}