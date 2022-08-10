<?php
function my_shortcode_handler($atts, $content = null) {
	$a = shortcode_atts(array(
		'attr_1' => 'attribute 1 default',
		'attr_2' => 'attribute 2 default',
		// ...etc
	), $atts);
}

add_shortcode('shortcode', 'my_shortcode_handler');
?>