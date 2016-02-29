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

class JobView implements Generator
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
        $attributes = shortcode_atts( array(
            'lang' => 'de'
        ), $attributes );

        if ( isset( $_REQUEST['job_id'] ) ) {
            $sql  = "SELECT * FROM {$this->wordpressConfig->wpDb->prefix}pablo_career_jobs
                     WHERE id='" . esc_sql( $_REQUEST['job_id'] ) . "' ";
            $jobs = $this->wordpressConfig->wpDb->get_results( $sql, 'ARRAY_A' );

            $job = array_shift( $jobs );
        }

        $this->smarty->assign( 'job', $job );
        $this->smarty->display( 'job.tpl' );

    }
}