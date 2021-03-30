<?php

/**
 * Plugin Name:       Extend Elementor Skin Classic | Braine
 * Description:       Plugin criado para extender a skin clássica do Elementor
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.0
 * Author:            Saulo Braine
 * Author URI:        https://braine.dev/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       extended-elementor-classic-skin
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function ExtendedSkinClassic() {
	add_action( 'elementor/widget/posts/skins_init', function( $widget ) {
		include_once( plugin_dir_path(__FILE__) . 'skin/extended-skin-classic.php');
		$widget->add_skin( new Extended_Skin_Classic( $widget ) );
	});

}

add_action('plugins_loaded', 'ExtendedSkinClassic', 0);