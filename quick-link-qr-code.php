<?php

/*
Plugin Name: Quick Link QR Code
Description: Generate QR codes for quick links in WordPress.
Version: 1.0.0
Author: Hasan
*/

register_activation_hook(__FILE__, function () { });
register_deactivation_hook(__FILE__, function () { });

/********************************************************** */

require_once(plugin_dir_path(__FILE__) . 'includes/class.qlqc-link-to-qrcode.php');


new QLQC_LINK_TO_QRCODE();