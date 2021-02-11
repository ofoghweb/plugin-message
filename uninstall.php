<?php

if (!defined('WP-UNINSTALL-PLUGIN')){
    die('error');
}

global $wpdb;

$mrn_DB=$wpdb->prefix .'user_message';

$wpdb->query("DROP TABLE IF EXISTS  {$mrn_DB}");