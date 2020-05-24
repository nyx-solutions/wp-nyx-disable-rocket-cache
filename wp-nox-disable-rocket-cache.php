<?php

	/**
	 * Plugin Name: Disable WP Rocket Cache
	 * Description: Disables WP Rocket’s page cache while preserving other optimization features. In order to enable the funcionality, use the constant NOX_DISABLE_ROCKET_CACHE with true
	 * Plugin URI:  https://github.com/nox-it/wp-nox-disable-rocket-cache
	 * Author:      NOX IT
	 * Author URI:  https://github.com/nox-it
	 * License:     GNU General Public License v2 or later
	 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
	 * Version:     1.0.0
	 */

	defined( 'ABSPATH' ) or die();

	defined( 'NOX_DISABLE_ROCKET_CACHE' ) or define( 'NOX_DISABLE_ROCKET_CACHE', false );

	if (NOX_DISABLE_ROCKET_CACHE) {
		/**
		 * Disable page caching in WP Rocket.
		 *
		 * @link http://docs.wp-rocket.me/article/61-disable-page-caching
		 */
		add_filter( 'do_rocket_generate_caching_files', '__return_false' );

		/**
		 * Cleans entire cache folder on activation.
		 */
		function nox_clean_wp_rocket_cache() {

			if ( ! function_exists( 'rocket_clean_domain' ) ) {
				return false;
			}

			// Purge entire WP Rocket cache.
			rocket_clean_domain();

			return true;
		}

		register_activation_hook( __FILE__, __NAMESPACE__ . 'nox_clean_wp_rocket_cache' );
	}
