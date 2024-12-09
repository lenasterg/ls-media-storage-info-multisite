=== LS Media Storage Info for Multisite ===
Contributors: lenasterg
Tags: media, storage, multisite, dashboard, space
Requires at least: 4.8
Tested up to: 6.7.1
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: ls-media-storage-info-multisite
Domain Path: /languages

Displays the total and used storage space in the Media Library of each subsite in WordPress Multisite . 

== Description ==
The **LS Media Storage Info for Multisite** plugin displays the used and available storage space in the Media Library of each subsite in WordPress Multisite . 
It shows useful information about your storage usage in the WordPress multimedia admin page and is especially helpful for admins of a subsite allowing them to keep track of their space usage.

= Features =
- Displays **used** and **available** storage space.
- Shows the information in the **Media Library** and **Add New Media** pages.
- Localization support for future translation.

== Installation ==

1. Upload the entire `ls-media-storage-info-multisite` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Go to the **Media Library** or **Add New Media** page in the WordPress admin, and you’ll see the used and available storage space displayed at the top of the page.

== Usage ==

Once the plugin is activated, it will display the **Media Storage Space** information at the top of the **Media Library** page and **Add New Media** page. It will show:
- **Used Space**: How much space has been used for media uploads.
- **Available Space**: The remaining space available for uploads.

This plugin works only in **WordPress Multisite** installations and will display storage information based on the current site.

== Changelog ==

= 1.0 =
* Initial release.

== Frequently Asked Questions ==

= Does this plugin work on single-site WordPress installations? =
No, this plugin is specifically designed to work on **WordPress Multisite** installations.

= Where is the storage information displayed? =
The used and available storage space is displayed on the **Media Library** page and the **Add New Media** page in the WordPress admin dashboard.

= Can I translate the plugin into my language? =
Yes, the plugin is **localization-ready**. You can add translations by creating language files using tools like **Poedit** or by contributing translations through WordPress.org.


== Screenshots == 
1. The Storage space info into the 'Media library' admin page
2. The Storage space info into the 'Upload media' window

== Upgrade Notice ==

= 1.0 =
Initial version

== Acknowledgements ==

This plugin utilizes the **Dashicons** library included in WordPress and the built-in functions for retrieving upload space data.
