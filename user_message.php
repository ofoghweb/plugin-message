<?php
/*
 * Plugin Name: پیام کاربران
 * Plugin URI:https://ofoghweb.com
 * Author:محمد رضا نجفی
 * Author URI:http://mohammad-reza-najafi.ir
 * Description:با نصب این افزونه امکان چت بین کاربران فراهم می شود
 * Version:1.0.0
 */

if (!defined('ABSPATH')){
    die('error');
}
class mrn_message{


    public function run()
    {
        $this->register();
        $this->makemenus();
        $this->makesubmenus();

      

    }
    public function register()
    {
        global $wpdb;
        $table=$wpdb->prefix.'user_message';
        $createQuery="CREATE TABLE `{$table}` (
             `id` int(11) NOT NULL AUTO_INCREMENT,
             `from_user` int(11) NOT NULL,
             `to_user` int(11) NOT NULL,
             `subject` varchar(250) COLLATE utf8_swedish_ci NOT NULL,
             `message` text COLLATE utf8_swedish_ci NOT NULL,
             `type` int(11) NOT NULL,
             `is_read` int(11) NOT NULL,
             `sent_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
             PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci";
        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($createQuery);
    }

    public function makemenus()
    {
        add_action('admin_menu',array($this,'main_menu'));
    }

    public function makesubmenus()
    {
        add_action('admin_menu',array($this,'submenu_sentetmessage'));
        add_action('admin_menu',array($this,'new_message'));
        add_action('admin_menu',array($this,'setting'));
    }

    public function main_menu()
    {

        add_menu_page('پیام کاربران'
            ,'پیام کاربران',
            'read',
            'marn_message_inbox',
            array($this,'inbox_view'),
            'dashicons-buddicons-pm',
            '14.26');
    }


    public function inbox_view()
    {
        require plugin_dir_path(__FILE__).'/views/payam_karbaran.php';
    }

    public function submenu_sentetmessage(){
        add_submenu_page( 
          'marn_message_inbox',
         'پیام های ارسالی',
         'پیام های ارسالی',
          'read', 
          'sended_message',
           array($this,'sended_view')
        );
    }

    public function sended_view(){
        require plugin_dir_path( __FILE__ ).'/views/sended_message.php';
    }

    public function new_message(){
        add_submenu_page( 
          'marn_message_inbox',
         'پیام  جدید',
         'پیام  جدید',
          'read', 
          'new_message',
           array($this,'new_message_view')
        );
    }

    public function new_message_view(){
        require plugin_dir_path( __FILE__ ).'/views/new_message.php';
    }

    public function setting(){
        add_submenu_page( 
          'marn_message_inbox',
         'تنظیمات',
         'تنظیمات',
          'administrator', 
          'setting',
           array($this,'setting_view')
        );
    }

    public function setting_view(){
        require plugin_dir_path( __FILE__ ).'/views/setting.php';
    }
}

$mrn=new mrn_message();
$mrn->run();


