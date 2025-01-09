<?php
/*
Plugin Name: LS Media Storage Info for Multisite
Description: Displays used and available storage space  in the Media Library of each subsite for WordPress Multisite.
Version: 1.0
Author: lenasterg
License: GPLv2 or later
Text Domain: ls-media-storage-info-multisite
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Displays used and available storage space for WordPress Multisite, in a notice
 *
 * @return void
 */
function lsmsms_display_notice_storage_info(): void {

	echo '<div class="notice notice-info is-dismissible">';
	lsmsms_display_storage_info();
	echo '</div>';
}

/**
 * Displays used and available storage space for WordPress Multisite
 *
 * @return void
 */
function lsmsms_display_storage_info(): void {
	// Get used and available space
	$quota = get_space_allowed();
	$used  = get_space_used();
	if ( $used > $quota ) {
		$percentused = 100;
	} else {
		$percentused = ( $used / $quota ) * 100;
	}
	$used        = round( $used, 2 );
	$percentused = number_format( $percentused );

	// Display the storage information with localization support

	echo '<p><strong>' . esc_html__( 'Storage Space','ls-media-storage-info-multisite' ) . ':</strong> ';

	$quota_t = sprintf(
				/* translators: %s: Number of megabytes. */
		__( '%s MB','ls-media-storage-info-multisite' ),
		number_format_i18n( $quota )
	);
	echo  esc_html($quota_t . ' / ');
	/* translators: 1: Number of megabytes, 2: Percentage. */
	$text = sprintf(
				/* translators: 1: Number of megabytes, 2: Percentage. */
		__( '%1$s MB (%2$s%%) Space Used','ls-media-storage-info-multisite' ),
		number_format_i18n( $used, 2 ),
		$percentused
	);
	echo esc_html($text);

	echo '</p>';
}

add_action( 'init', 'lsmsms_media_storage_info_load_textdomain' );

function lsmsms_media_storage_info_load_textdomain(): void {
	load_plugin_textdomain( 'ls-media-storage-info-multisite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

/**
 * Displays the storage info on the Media Library page and on the 'upload media' window.
 *
 * @param string $hook_suffix The page hook name
 * @return void
 */
function lsmsms_show_storage_info_on_media_page( $hook_suffix ): void {
	// Check if it's a multisite
	if ( ! is_multisite() || ! current_user_can( 'upload_files' ) || get_site_option( 'upload_space_check_disabled' )
	) {
		return;
	} else {
		if ( ( 'media-new.php' === $hook_suffix ) || ( 'upload.php' === $hook_suffix ) ) { // Media Library page
			add_action( 'admin_notices', 'lsmsms_display_notice_storage_info' );
		} else {
			add_action( 'post-upload-ui', 'lsmsms_display_storage_info' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'lsmsms_show_storage_info_on_media_page' );
