<?php

/*
Plugin Name: RAMP Settings From wp-config.php
Plugin URI: http://crowdfavorite.com/ramp/
Description: Allow RAMP settings to be pulled from wp-config.php instead of the database.
Version: 1.0
Author: Crowd Favorite
Author URI: http://crowdfavorite.com
License: GPL2
*/

/*

Tells RAMP to use constants, if they are defined, instead of DB settings.

Put these into your wp-config.php file as desired:

define('RAMP_LOCAL_KEY', '1234567890');
define('RAMP_REMOTE_URL', 'http://example.com/');
define('RAMP_REMOTE_KEY', '1234567890');
define('RAMP_QUICKSEND', 'on'); // on or off

*/

function cf_ramp_config($settings) {
	if (defined('RAMP_LOCAL_KEY')) {
		$settings['auth_key'] = RAMP_LOCAL_KEY;
	}
	if (defined('RAMP_REMOTE_URL')) {
		$settings['remote_server'][0]['address'] = RAMP_REMOTE_URL;
	}
	if (defined('RAMP_REMOTE_KEY')) {
		$settings['remote_server'][0]['key'] = RAMP_REMOTE_KEY;
	}
	if (defined('RAMP_QUICKSEND')) {
		switch (RAMP_QUICKSEND) {
			case 'on':
				$settings['quicksend'] = RAMP_QUICKSEND;
			break;
			case 'off':
				unset($settings['quicksend']);
			break;
		}
	}
	return $settings;
}
add_filter('option_cfd_settings', 'cf_ramp_config');
