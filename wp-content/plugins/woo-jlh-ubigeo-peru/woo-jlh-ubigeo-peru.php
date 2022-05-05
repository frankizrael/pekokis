<?php
/* 
 * Plugin Name: WooCommerce JLH Ubigeo Peru
 * Description: Ubigeo Peru
 * Version: 1.0.1
 * Author: Estratega.pe
 * Author URI: https://estratega.pe
 * Contributors: Jose Luis Huamani Gonzales
 * License: GPLv3
 * Text Domain: woo-jlh-ubigeo-peru
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 5.5
 * WC requires at least: 3.0.x
 * WC tested up to: 4.5
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Exit if file is open directly
if ( ! defined( 'ABSPATH' ) ) exit;

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    define('WOOJLHUP_PLUGIN_PATH', plugin_dir_path(__FILE__));
    define('WOOJLHUP_PLUGIN_URL', plugin_dir_url(__FILE__));
    require dirname(__FILE__) . "/woojlhup_setup.php";

    register_activation_hook(__FILE__, 'woojlhup_setup');
    register_deactivation_hook(__FILE__, 'woojlh_uninstall');

    function woojlhup_init() {
        load_plugin_textdomain('woo-jlh-ubigeo-peru', FALSE,  dirname(plugin_basename(__FILE__)) . '/languages');
        require dirname(__FILE__) . "/woojlhup_endpoints.php";
        require dirname(__FILE__) . "/woojlhup_woocommerce.php";
    }

    add_action('plugins_loaded', 'woojlhup_init');
} else {
    function pdpw_woocommerce_required() {
        $error_wc = wp_sprintf(__('%sWoo JLH Ubigeo Peru%s plugin requires %sWooCommerce%s activated. The plugin was deactivated until you active %sWooCommerce%s', 'woo-jlh-ubigeo-peru'), '<strong>', '</strong>', '<strong>', '</strong>', '<strong>', '</strong>');
        echo '
        <div class="notice notice-error is-dismissible">            
                <p>' . $error_wc . '</p>
            </div>
            ';
        deactivate_plugins(plugin_basename(__FILE__));
      }
      add_action('admin_notices', 'pdpw_woocommerce_required');
}
