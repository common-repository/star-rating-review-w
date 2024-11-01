<?php
/*
Plugin Name: Star Rating Review for Welcart
Plugin URI: http://templx.com/
Description: This plugin am dedicated to Welcart-Commerce. Welcarte-Commerce Valid only when Available.
Author: TEMPLX
Version: 1.1
Text Domain: TEMPLX
Author URI: http://templx.com/
*/

 define('SRRWTX_VERSION', '1.1');
 define('SRRWTX_PLUGIN_DIR', plugin_dir_path(__FILE__));
 define('SRRWTX_PLUGIN_URL', plugin_dir_url(__FILE__));

  function srrwtx_update_setting(){
    update_option('SRRWTX_VERSION', '1.1');
  }
  register_activation_hook(__FILE__, 'srrwtx_update_setting');

    $srrwtx_languages = basename(dirname(__FILE__));
    load_plugin_textdomain('srrwtx', false, $srrwtx_languages. '/languages');
    require_once(SRRWTX_PLUGIN_DIR.'srrwtx_function.php');

       function srrwtx_css_style(){
          wp_enqueue_style('srrwtx', SRRWTX_PLUGIN_URL.'css/srrwtx.css', array(), NULL, 'all');
       }
       add_action('wp_enqueue_scripts', 'srrwtx_css_style');
?>