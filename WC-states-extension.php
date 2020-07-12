<?php
/**
 * Plugin Name: WC States Extension
 * Plugin URI: https://github.com/DevWael/WC-States-Extension
 * Description: WordPress Plugins that adds Arabian states to woocommerce.
 * Version: 1.0
 * Author: Ahmad Wael
 * Author URI: https://github.com/DevWael
 * License: GPL2
 * Text Domain: wcse
 */

defined( 'ABSPATH' ) || exit; //prevent direct file access
define( 'WCSE_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Classes autoloader
 */
spl_autoload_register( 'wcse_autoloader' );
function wcse_autoloader( $class_name ) {
	$classes_dir = WCSE_DIR . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR;
	$class_file  = $class_name . '.php';
	$class       = $classes_dir . $class_file;
	if ( file_exists( $class ) ) {
		require_once $class;
	}

	return false;
}

class WCSE_States {
	protected $saudi;
	protected $emirates;

	public function __construct() {
		$this->saudi    = new WCSE_Saudi;
		$this->emirates = new WCSE_Emirates;
	}

	public function init() {
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ), 10 );
		add_filter( 'woocommerce_states', array( $this, 'states' ), 100, 1 );
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'wcse',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

	/**
	 * Load current supported states to woocommerce
	 *
	 * @param $states
	 *
	 * @return array $states
	 */
	public function states( $states ) {
		$states['SA'] = $this->saudi->states();
		$states['AE'] = $this->emirates->states();

		return $states;
	}

}

$wcse = new WCSE_States();
$wcse->init();

/**
 * Plugin Update Service
 */
require WCSE_DIR . 'plugin-update-checker-4.9/plugin-update-checker.php';
add_action( 'plugins_loaded', function () {
	Puc_v4_Factory::buildUpdateChecker(
		'https://github.com/DevWael/WC-States-Extension',
		__FILE__,
		'WC-States-Extension',
		24
	);
} );