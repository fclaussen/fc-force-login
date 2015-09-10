<?php

/**
 * 
 * @link              http://fernandoclaussen.com
 * @since             1.0.0
 * @package           FC_Force_Login
 *
 * Plugin Name:       Force Plugin
 * Plugin URI:        http://fernandoclaussen.com
 * Description:       A small plugin that forces the user to login and be an admin before being able to see anything.
 * Version:           1.0.0
 * Author:            Fernando Claussen
 * Author URI:        http://fernandoclaussen.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fc-force-login
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'template_redirect', 'fc_force_login' );

function fc_force_login()
{
	$redirect_to = $_SERVER['REQUEST_URI'];
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

	if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ))
	{
		header( 'Location: '.home_url('/').'wp-login.php?redirect_to=' . $protocol . $_SERVER['SERVER_NAME'].$redirect_to );
		die();
  	}

}