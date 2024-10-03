<?php
/**
 * Reading Position Indicator
 *
 * @package           reading-position-indicator
 * @author            Marcin Pietrzak
 * @copyright         2017-2024 Marcin Pietrzak
 * @license           GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Reading Position Indicator
 * Plugin URI:        https://github.com/iworks/reading-position-indicator
 * Description:       Create a vertical progress bar to show how scroll progress of current single entry.
 * Version:           1.0.8
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
 * i18n
 */
function irpi_load_plugin_textdomain() {
	load_plugin_textdomain(
		'reading-position-indicator',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages/'
	);
}
add_action( 'plugins_loaded', 'irpi_load_plugin_textdomain' );

/**
 * load options
 */
/**
 * load options
 */

global $iworks_reading_position_indicator_options;
$iworks_reading_position_indicator_options = iworks_reading_position_indicator_get_options_object();

function iworks_reading_position_indicator_get_options_object() {
	global $iworks_reading_position_indicator_options;
	if ( is_object( $iworks_reading_position_indicator_options ) ) {
		return $iworks_reading_position_indicator_options;
	}
	$iworks_reading_position_indicator_options = new iworks_options();
	$iworks_reading_position_indicator_options->set_option_function_name( 'iworks_reading_position_indicator_options' );
	$iworks_reading_position_indicator_options->set_option_prefix( 'irpi_' );
	$iworks_reading_position_indicator_options->init();
	return $iworks_reading_position_indicator_options;
}

function iworks_reading_position_indicator_activate() {
	$iworks_reading_position_indicator_options = get_iworks_reading_position_indicator_options();
	$iworks_reading_position_indicator_options->activate();
}

function iworks_reading_position_indicator_deactivate() {
	$iworks_reading_position_indicator_options->set_option_prefix( iworks_reading_position_indicator );
	$iworks_reading_position_indicator_options->deactivate();
}
/**
 * start
 */
new iworks_position();

/**
 * Register to iWorks Rate!
 */
include_once dirname( __FILE__ ) . '/includes/iworks/rate/rate.php';
do_action(
	'iworks-register-plugin',
	plugin_basename( __FILE__ ),
	__( 'Reading Position Indicator ', 'reading-position-indicator' ),
	'reading-position-indicator'
);

