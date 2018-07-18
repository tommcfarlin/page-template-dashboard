<?php
/**
 * Page Template Dashboard
 *
 * An easy way to see which templates your pages are using without having to view the page editor.
 *
 * @package   PTD
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 * @license   GPL-2.0+
 * @link      https://tommcfarlin.com/page-template-dashboard/
 * @copyright 2013 - 2016 Tom McFarlin
 *
 * @wordpress-plugin
 * Plugin Name: Page Template Dashboard
 * Plugin URI:  https://tommcfarlin.com/page-template-dashboard/
 * Description: An easy way to see which templates your pages are using without having to view the page editor.
 * Version:     1.8.0
 * Author:      Tom McFarlin
 * Author URI:  https://tommcfarlin.com/
 * Text Domain: page-template-dashboard-locale
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

defined( 'WPINC' ) || die;

include_once 'class-page-template-dashboard.php' ;

add_action( 'plugins_loaded', 'ptd_start' );
/**
 * Starts the plugin.
 */
function ptd_start() {

	$plugin = new Page_Template_Dashboard();
	$plugin->init();
}
