<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 25.02.16
 * Time: 17:30
 */

namespace PabloCareer\Plugin\Admin\Handlers;


class JobForm
{
    /**
     * Stores the tablename for the list
     *
     * @var string
     */
    private $tableName;

    /**
     * @var \wpdb
     */
    private $database;

    /**
     * @var mixed
     */
    private $msg;

    /**
     * @var mixed
     */
    private $notice;

    /**
     * @var array
     */
    private $item;


    /**
     * @param \wpdb $wpdb
     */
    public function __construct(\wpdb $wpdb)
    {
        $this->database  = $wpdb;
        $this->tableName = $this->database->prefix . "pablo_career_jobs";
    }

    /**
     * @param array $form_data
     */
    public function handle(array $form_data)
    {
        if (array_key_exists('_wpnonce', $form_data) && wp_verify_nonce($form_data['_wpnonce'],
                'pablo-career-admin-nonce')
        ) {
            $this->item = shortcode_atts($this->getItem(), $form_data);

            if ($this->validateItem()) {
                if ($this->item['id'] == 0) {
                    $result = $this->database->insert($this->tableName, $this->item);

                    $this->item['id'] = $this->database->insert_id;
                    if ($result) {
                        $this->msg = __('Job Offer was successfully saved', 'pablo-career');
                    } else {
                        $this->notice = __('There was an error while saving Job Offer', 'pablo-career');
                    }
                } else {
                    // update creation date
                    $this->item['creationdate'] = date('Y-m-d H:i:s');

                    $result = $this->database->update($this->tableName, $this->item,
                        array('id' => $this->item['id']));
                    if ($result) {
                        $this->msg = __('Job Offer was successfully updated', 'pablo-career');
                    } else {
                        $this->notice = __('There was an error while updating Job Offer', 'pablo-career');
                    }
                }
            }

        } else {
            if (isset( $form_data['id'] )) {
                $item = $this->database->get_row(
                    $this->database->prepare("SELECT * FROM " . $this->tableName . " WHERE id = %d",
                        $form_data['id']),
                    ARRAY_A
                );

                if ($item) {
                    $this->item = $item;

                    return;
                }

                $this->notice = __('Job Offer not found', 'pablo-career');
            }
        }
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return mixed
     */
    public function getNotice()
    {
        return $this->notice;
    }

    /**
     * Returns the job offer item or creates one
     *
     * @return array
     */
    public function getItem()
    {
        if ( ! $this->item) {
            $this->item = array(
                'id'                      => 0,
                'title'                   => '',
                'description'             => '',
                'creationdate'            => date('Y-m-d H:i:s'),
                'working_hours'           => '',
                'qualifications'          => '',
                'requirements'            => '',
                'additional_informations' => '',
                'wage'                    => '',
                'workplace'               => '',
                'branch'                  => '',
                'others'                  => '',
                'active'                  => false,
                'languageid'              => 'de'
            );
        }

        return $this->item;
    }

    /**
     * Validates current item.
     * Atm returns only true because all validation is handled by javascript
     *
     * @return bool
     */
    private function validateItem()
    {
        return true;
    }
}