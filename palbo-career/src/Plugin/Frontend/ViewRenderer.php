<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 21:25
 */

namespace PabloCareer\Plugin\Frontend;


use PabloCareer\Plugin\Frontend\Service\Generator\JobList;
use PabloCareer\Plugin\Frontend\Service\Generator\JobView;
use PabloCareer\Plugin\Frontend\Service\Generator\ShortCode as ShortCodeGenerator;
use PabloCareer\Plugin\Struct\ShortCode;
use PabloCareer\Plugin\Struct\WordpressConfig;

class ViewRenderer
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

        $shortCodeGenerator = new ShortCodeGenerator();

        $shortCodeGenerator->add(
            new ShortCode(
                array(
                    "tag"      => "joboffer-list",
                    "object"   => new JobList($this->smarty, $this->wordpressConfig),
                    "callback" => "generate"
                )
            )
        );

        $shortCodeGenerator->add(
            new ShortCode(
                array(
                    "tag"      => "joboffer-view",
                    "object"   => new JobView($this->smarty, $this->wordpressConfig),
                    "callback" => "generate"
                )
            )
        );

        $shortCodeGenerator->generate(null);
    }

    //@TODO Check if these functions are at the right place
    /**
     * @param $params
     * @param $smarty
     *
     * @return string
     */
    public function getSortUrl($params, $smarty)
    {
        $current_url = get_permalink(get_the_ID());
        $new_url     = add_query_arg('order', $params['direction'],
            add_query_arg('orderby', $params['sort'], $current_url));

        return $new_url;
    }

    /**
     * @param $params
     * @param $smarty
     *
     * @return string
     */
    public function getSingleJobUrl($params, $smarty)
    {
        $uri    = add_query_arg('pagename', 'job_display',
            add_query_arg('job_id', $params['id'], home_url($this->wordpressConfig->wp->request)));
        $option = get_option('pablo_single_page', '-1');

        if ($option != '-1') {
            $uri = add_query_arg('page_id', get_option('pablo_single_page'),
                add_query_arg('job_id', $params['id'], home_url($this->wordpressConfig->wp->request)));
        }

        return $uri;
    }

    /**
     * @return false|string
     */
    public function getBackLink()
    {
        $request_uri = $_SERVER['REQUEST_URI'];

        if ($request_uri != wp_get_referer()) {
            return wp_get_referer();
        }

        return get_home_url('/');
    }

    /**
     * Redirect user if no page is set
     */
    public function jobRedirect()
    {
        if (isset( $this->wordpressConfig->wp->query_vars['pagename'] ) &&
            $this->wordpressConfig->wp->query_vars['pagename'] == "job_display"
        ) {

            if (isset( $_REQUEST['job_id'] )) {
                $sql  = "SELECT * FROM {$this->wordpressConfig->wpDb->prefix}pablo_career_jobs
                         WHERE id='" . esc_sql($_REQUEST['job_id']) . "' ";
                $jobs = $this->wordpressConfig->wpDb->get_results($sql, 'ARRAY_A');

                $job                                     = array_shift($jobs);
                $this->wordpressConfig->wpQuery->is_404 = false;

                $this->smarty->assign('job', $job);
                $this->smarty->display('job-layout.tpl');
            }
            $this->wordpressConfig->wpQuery->is_404 = true;
        }
    }
}