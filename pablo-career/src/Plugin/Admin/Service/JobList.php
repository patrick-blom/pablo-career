<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 25.02.16
 * Time: 17:29
 */

namespace PabloCareer\Plugin\Admin\Service;


class JobList extends \WP_List_Table
{

    /**
     * Stores the tablename for the list
     *
     * @var string
     */
    private $table_name = "pablo_career_jobs";

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct()
    {

        parent::__construct(array(
            'singular' => __('job', 'pablo-career'),
            'plural'   => __('jobs', 'pablo-career'),
            'ajax'     => false
        ));
    }

    /** Text displayed when no customer data is available */
    public function no_items()
    {
        _e('No jobs avaliable.', 'pablo-career');
    }

    /**
     * Get a list of columns. The format is:
     * 'internal-name' => 'Title'
     *
     * @since 3.1.0
     * @access public
     * @abstract
     *
     * @return array
     */
    public function get_columns()
    {
        return array(
            'cb'            => '<input type="checkbox" />',
            'title'         => __('Title', 'pablo-career'),
            'branch'        => __('Branch', 'pablo-career'),
            'working_hours' => __('Working Houre', 'pablo-career'),
            'creationdate'  => __('Creation Date', 'pablo-career'),
            'active'        => __('Active', 'pablo-career'),
            'languageid'    => __('Language', 'pablo-career')
        );
    }

    /**
     * Get a list of hidden columns. The format is:
     * 'internal-name' => 'Title'
     *
     * @since 3.1.0
     * @access public
     * @abstract
     *
     * @return array
     */
    public function get_hidden_columns()
    {
        return array(
            'id',
            'qualifications',
            'requirements',
            'wage',
            'workplace',
            'others',
            'description',
        );
    }

    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions()
    {
        $actions = array(
            'bulk-delete'     => __('Delete'),
            'bulk-activate'   => __('Activate'),
            'bulk-deactivate' => __('Deactivate'),
        );

        return $actions;
    }

    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items()
    {

        /** Process delete action */
        $this->process_delete_action();
        $this->process_state_action();

        $columns  = $this->get_columns();
        $hidden   = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);

        $per_page     = $this->get_items_per_page('jobs_per_page', 10);
        $current_page = $this->get_pagenum();
        $total_items  = $this->record_count();

        $this->set_pagination_args([
            'total_items' => $total_items, //WE have to calculate the total number of items
            'per_page'    => $per_page //WE have to determine how many items to show on a page
        ]);

        $this->items = $this->get_jobs($per_page, $current_page);
    }

    /**
     * Deletes the a job or a bulk of jobs
     */
    public function process_delete_action()
    {

        //Detect when a bulk action is being triggered...
        if ('delete' === $this->current_action()) {

            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr($_REQUEST['_wpnonce']);

            if ( ! wp_verify_nonce($nonce, 'pablo_list_edit')) {
                die( 'Go get a life script kiddies' );
            } else {
                $this->delete_job(absint($_GET['job']));
            }

        }

        // If the delete bulk action is triggered
        if (( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
            || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
        ) {

            $delete_ids = esc_sql($_POST['bulk-action']);

            // loop over the array of record ids and delete them
            foreach ($delete_ids as $id) {
                $this->delete_job($id);
            }
        }
    }

    /**
     * Deletes a single job
     *
     * @param $id
     */
    public function delete_job($id)
    {
        global $wpdb;

        $wpdb->delete(
            $wpdb->prefix . $this->table_name,
            array('id' => $id),
            array('%d')
        );
    }

    /**
     * Sets a job active or inactive
     */
    public function process_state_action()
    {

        //Detect when a bulk action is being triggered...
        if ('setstate' === $this->current_action()) {

            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr($_REQUEST['_wpnonce']);

            if ( ! wp_verify_nonce($nonce, 'pablo_list_edit')) {
                die( 'Go get a life script kiddies' );
            } else {
                $this->set_jobstate(absint($_GET['job']), absint($_GET['state']));
            }

        }

        // If the activate bulk action is triggered
        if (( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-activate' )
            || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-activate' )
            || ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-deactivate' )
            || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-deactivate' )
        ) {

            $state = $_POST['action'] == 'bulk-activate' || $_POST['action2'] == 'bulk-activate' ? 1 : 0;

            $bulk_ids = esc_sql($_POST['bulk-action']);

            // loop over the array of record ids and delete them
            foreach ($bulk_ids as $id) {
                $this->set_jobstate($id, $state);
            }
        }
    }

    /**
     * Deletes a single job
     *
     * @param $id
     * @param $state
     */
    public function set_jobstate($id, $state)
    {
        global $wpdb;

        $wpdb->update($wpdb->prefix . $this->table_name,
            array('active' => $state),
            array('id' => $id)
        );
    }

    /**
     * Returns the count of records in the database.
     *
     * @return null|string
     */
    public function record_count()
    {
        global $wpdb;

        $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}{$this->table_name}";

        return $wpdb->get_var($sql);
    }

    /**
     * Get all jobs from the database
     *
     * @since    1.0.0
     *
     * @param int $per_page
     * @param int $page_number
     *
     * @return array|null|object
     */
    public function get_jobs($per_page = 10, $page_number = 1)
    {
        global $wpdb;

        $sql = "SELECT * FROM {$wpdb->prefix}{$this->table_name}";

        if ( ! empty( $_REQUEST['orderby'] )) {
            $sql .= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
            $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql($_REQUEST['order']) : ' ACS';
        }

        $sql .= " LIMIT $per_page";
        $sql .= " OFFSET " . ( $page_number - 1 ) * $per_page;

        $result = $wpdb->get_results($sql, 'ARRAY_A');

        return $result;
    }

    /**
     * Method for name title
     *
     * @param $item
     *
     * @return string
     */
    protected function column_title($item)
    {

        $title = '<strong>' . $item['title'] . '</strong>';

        $state_label = $item['active'] ? __('Deactivate') : __('Activate');

        $actions = array(
            'setstate' => sprintf('<a href="?page=%s&action=%s&job=%s&state=%s&_wpnonce=%s">' . $state_label . '</a>',
                esc_attr($_REQUEST['page']),
                'setstate',
                absint($item['id']),
                absint(! $item['active']),
                wp_create_nonce('pablo_list_edit')
            ),
            'edit'     => sprintf('<a href="?page=job_form&action=%s&id=%s">' . __('Edit') . '</a>',
                'edit',
                absint($item['id'])
            ),
            'delete'   => sprintf('<a href="?page=%s&action=%s&job=%s&_wpnonce=%s">' . __('Delete') . '</a>',
                esc_attr($_REQUEST['page']),
                'delete',
                absint($item['id']),
                wp_create_nonce('pablo_list_edit')
            )
        );

        return $title . $this->row_actions($actions);
    }

    /**
     *
     * @param object $item
     * @param string $column_name
     *
     * @return string
     */
    protected function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'creationdate':
            case 'branch':
            case 'working_hours':
                return $item[$column_name];
            default:
                return print_r($item, true); //Show the whole array for troubleshooting purposes
        }
    }

    /**
     * Render the bulk edit checkbox
     *
     * @param array $item
     *
     * @return string
     */
    protected function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="bulk-action[]" value="%s" />', $item['id']
        );
    }

    /**
     * Render the active checkbox
     *
     * @param array $item
     *
     * @return string
     */
    protected function column_active($item)
    {
        return sprintf(
            '<div class="dashicons-before  %s"/>',
            $item['active'] ? 'dashicons-visibility' : 'dashicons-hidden'
        );
    }

    /**
     * Render the language item
     *
     * @param array $item
     *
     * @return string
     */
    protected function column_languageid($item)
    {
        return __('language_' . $item['languageid'], 'pablo-career');
    }

    /**
     * Get a list of sortable columns. The format is:
     * 'internal-name' => 'orderby'
     * or
     * 'internal-name' => array( 'orderby', true )
     *
     * The second format will make the initial sorting order be descending
     *
     * @since 3.1.0
     * @access protected
     *
     * @return array
     */
    protected function get_sortable_columns()
    {
        return array(
            'title'         => array('title', true),
            'branch'        => array('branch', true),
            'working_hours' => array('working_hours', true),
            'creationdate'  => array('creationdate', true),
            'active'        => array('active', true),
            'languageid'    => array('languageid', true),
        );
    }
}