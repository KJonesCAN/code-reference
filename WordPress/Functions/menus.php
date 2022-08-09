<?php
/* Register Menu Areas */
 
function kjca_register_menus () {
	register_nav_menus(
		array(
			'header-menu' => __('Header'),
			'mobile-menu' => __('Mobile'),
			'sidebar-menu' => __('Sidebar'),
			'footer-menu' => __('Footer')
		)
	);
}

add_action('init', 'kjca_register_menus');
?>