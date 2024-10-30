<?php
/*
Plugin Name: Bitcoin Payments
Plugin URI: http://wordpress.org/plugins/bitcoin-payments/
Description: Allow people to make Bitcoin Payments to you by displaying your address or QRCode.  Use Widgets or Shortcodes to place a custom addresses.
Author: James Turner
Author URI: http://www.jamesturner.co.nz
Version: 1.4.2
Text Domain: bitcoin-payments
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
global $wpdb;

if (!defined('BTCP_VERSION_KEY'))
    define('BTCP_VERSION_KEY', 'BTCP_version');

if (!defined('BTCP_VERSION_NUM'))
    define('BTCP_VERSION_NUM', '1.4.2');

/** Display verbose errors */
define('IMPORT_DEBUG', true);
define('BTCP_ADDRESS', '17Xvz6QzceYfD5MW8hwup1Nr4wTnEY8fV2'); // Bitcoin Address
define('LTCP_ADDRESS', 'Lb6LETF1RyvEBvhEekNEUFR7oj19XeZRWh'); // Litecoin Address
define('DTCP_ADDRESS', 'DTgguHQ7wht2oRoHD2haduV6QKsaxdSdfn'); // Dogecoin Address
define('BTCP_QRCODE_HEIGHT', 150);
define('BTCP_QRCODE_WIDTH', 150);

/* Include ability to handle custom shortcode */
include_once dirname( __FILE__ ) . '/btcp-shortcode.php';
include_once dirname( __FILE__ ) . '/btcp-widget.php';

add_action('wp_enqueue_scripts', 'btcp_scripts');
add_action('admin_init', 'btcp_admin_init');
add_action('admin_menu', 'btcp_settings_menu');

function btcp_admin_init() {
	/* Register our stylesheet. http://codex.wordpress.org/Function_Reference/wp_enqueue_style */
	wp_register_style('btcpStylesheet', plugins_url('style-admin.css', __FILE__));
	wp_enqueue_script('btcp_javascript_tabs', plugins_url( '/javascript/tabs.js' , __FILE__ ));
	wp_enqueue_script('btcp_jqueryqrcode', plugins_url( '/javascript/jquery.qrcode.min.js' , __FILE__ ));
	
	register_setting('btcp_plugin_options', 'btcp_options', 'btcp_plugin_options_validate');
} // END function btcp_admin_init()

function btcp_settings_menu() {
    $page_title = 'Bitcoin Payments Settings';
    $menu_title = 'Bitcoin Payments';
    $capability = 'manage_options';
    $menu_slug = 'btcp-settings';
    $function = 'btcp_settings';
    $page = add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
	
	add_action('admin_print_styles-' . $page, 'btcp_admin_styles');
	
} // END function btcp_settings_menu()

function btcp_admin_styles() {
   /*
	* It will be called only on your plugin admin page, enqueue our stylesheet here
	*/
	wp_enqueue_style('btcpStylesheet');
} // END function btcp_admin_styles()

function btcp_scripts() {
	wp_enqueue_script("jquery");
	wp_enqueue_script('btcp_jqueryqrcode', plugins_url( '/javascript/jquery.qrcode.min.js' , __FILE__ ));
	
	// Front End CSS
	wp_register_style('btcp-style', plugins_url( 'style.css' , __FILE__ ));
	wp_enqueue_style('btcp-style');
} // END function btcp_scripts()

function btcp_settings() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
	
    include_once dirname( __FILE__ ) . '/btcp-settings.php';
} // END function btcp_settings()

// validate our options
function btcp_plugin_options_validate($input) {
	$input['address'] = wp_filter_nohtml_kses($input['address']);
	$input['show_address_href'] = $input['show_address_href'];
	$input['address_prefix'] = $input['address_prefix'];
	$input['address_postfix'] = $input['address_postfix'];
	$input['height'] = $input['height'];
	$input['width'] = $input['width'];
	
	return $input;
} // END function btcp_plugin_options_validate

?>