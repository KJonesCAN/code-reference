<?php
/* Register Widget Areas */

function kjca_widgets_init () {
    
	register_sidebar(
		array(
			'name' => 'Widget Area Name',
			'id' => 'widget-area-id'
		)
	);

}

add_action('widgets_init', 'kjca_widgets_init');
?>