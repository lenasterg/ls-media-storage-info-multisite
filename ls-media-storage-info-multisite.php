<?php
/*
Plugin Name: LS Media Storage Info for Multisite
Description: Displays used and available storage space in the Media Library for WordPress Multisite.
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
function display_notice_storage_info_multisite() {

	echo '<div class="notice notice-info is-dismissible">';
	display_storage_info_multisite();
	echo '</div>';
}

/**
 * Displays used and available storage space for WordPress Multisite
 *
 * @return void
 */
function display_storage_info_multisite() {
	// Get used and available space
	$quota = get_space_allowed();
	$used  = get_space_used();
	if ( $used > $quota ) {
		$percentused = '100';
	} else {
		$percentused = ( $used / $quota ) * 100;
	}
	$used        = round( $used, 2 );
	$percentused = number_format( $percentused );

	// Display the storage information with localization support

	echo '<p><strong>' . esc_html__( 'Storage Space' ) . ':</strong> ';

	$quota_t = sprintf(
				/* translators: %s: Number of megabytes. */
		__( '%s MB' ),
		number_format_i18n( $quota )
	);
	echo  esc_html($quota_t . ' / ');
	/* translators: 1: Number of megabytes, 2: Percentage. */
	$text = sprintf(
				/* translators: 1: Number of megabytes, 2: Percentage. */
		__( '%1$s MB (%2$s%%) Space Used' ),
		number_format_i18n( $used, 2 ),
		$percentused
	);
	echo esc_html($text);

	echo '</p>';
}

/**
 * Displays the storage info on the Media Library page and on the 'upload media' window.
 *
 * @param string $hook_suffix The page hook name
 * @return void
 */
function show_storage_info_on_media_page( $hook_suffix ) {
	// Check if it's a multisite
	if ( ! is_multisite() || ! current_user_can( 'upload_files' ) || get_site_option( 'upload_space_check_disabled' )
	) {
		return true;
	} else {
		if ( ( 'media-new.php' === $hook_suffix ) || ( 'upload.php' === $hook_suffix ) ) { // Media Library page
			add_action( 'admin_notices', 'display_notice_storage_info_multisite' );
		} else {
			add_action( 'post-upload-ui', 'display_storage_info_multisite' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'show_storage_info_on_media_page' );

