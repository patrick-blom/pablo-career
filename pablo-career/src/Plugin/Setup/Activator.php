<?php
/**
 * Created by PhpStorm.
 * User: patrickblom
 * Date: 24.02.16
 * Time: 21:08
 */

namespace PabloCareer\Plugin\Setup;


class Activator
{
    /**
     * @var string
     */
    private static $pabloDbVersion = "1.0.0";

    /**
     * setup my database
     */
    public static function activate()
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();
        $tableName      = $wpdb->prefix . "pablo_career_jobs";

        if ($wpdb->get_var("show tables like '$tableName'") != $tableName) {

            $sql = "CREATE TABLE $tableName (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                title varchar(255) DEFAULT '' NOT NULL,
                description text NOT NULL,
                creationdate datetime DEFAULT '0000-00-00 00:00:00'  NOT NULL,
                working_hours varchar(255) DEFAULT '' NOT NULL,
                qualifications varchar(255) DEFAULT '' NOT NULL,
                requirements varchar(255) DEFAULT '' NOT NULL,
                additional_informations text NOT NULL,
                wage varchar(255) DEFAULT '' NOT NULL,
                workplace varchar(255) DEFAULT '' NOT NULL,
                branch varchar(255) DEFAULT '' NOT NULL,
                others text NOT NULL,
                active tinyint(1) DEFAULT '0' NOT NULL,
                languageid varchar(40) DEFAULT 'de' NOT NULL,
                UNIQUE KEY id (id)
            ) $charsetCollate;";

            //@TODO Remove abs path
            require_once( ABSPATH . "wp-admin/includes/upgrade.php" );
            dbDelta($sql);

            if ( ! get_option("pablo_db_version")) {
                add_option('pablo_db_version', self::$pabloDbVersion);
            }
        }
    }
}