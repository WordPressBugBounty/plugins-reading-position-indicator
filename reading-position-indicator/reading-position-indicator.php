<?php
/**
 * Reading Position Indicator
 *
 * @package           reading-position-indicator
 * @author            Marcin Pietrzak
 * @copyright         2017-2025 Marcin Pietrzak
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Reading Position Indicator
 * Plugin URI:        https://github.com/iworks/reading-position-indicator
 * Description:       A sleek, customizable vertical progress bar that visually indicates readers' scroll position on your WordPress posts and pages.
 * Version:           1.2.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            Marcin Pietrzak
 * Author URI:        http://iworks.pl/
 * Text Domain:       reading-position-indicator
 * License:           GPL v3 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

include_once dirname( __FILE__ ) . '/etc/options.php';

$includes = dirname( __FILE__ ) . '/includes';

if ( ! class_exists( 'iworks_options' ) ) {
	include_once $includes . '/iworks/options/options.php';
}
include_once $includes . '/iworks/class-iworks-position.php';

/**
 * load options
 */

global $iworks_reading_position_indicator_options;
$iworks_reading_position_indicator_options = null;

function iworks_reading_position_indicator_get_options_object() {
	global $iworks_reading_position_indicator_options;
	if ( is_object( $iworks_reading_position_indicator_options ) ) {
		return $iworks_reading_position_indicator_options;
	}
	$iworks_reading_position_indicator_options = new iworks_options();
	$iworks_reading_position_indicator_options->set_option_function_name( 'iworks_reading_position_indicator_options' );
	$iworks_reading_position_indicator_options->set_option_prefix( 'irpi_' );
	if ( method_exists( $iworks_reading_position_indicator_options, 'set_plugin' ) ) {
		$iworks_reading_position_indicator_options->set_plugin( basename( __FILE__ ) );
	}
	$iworks_reading_position_indicator_options->options_init();
	return $iworks_reading_position_indicator_options;
}

function iworks_reading_position_indicator_activate() {
	$iworks_reading_position_indicator_options = iworks_reading_position_indicator_get_options_object();
	$iworks_reading_position_indicator_options->activate();
}

function iworks_reading_position_indicator_deactivate() {
	$iworks_reading_position_indicator_options = iworks_reading_position_indicator_get_options_object();
	$iworks_reading_position_indicator_options->deactivate();
}
/**
 * start
 */
new iworks_position();

