<?php
/* the_content() */

add_filter( 'the_content', 'filter_the_content_in_the_main_loop', 1 );

function filter_the_content_in_the_main_loop ($content) {
	$content .= '<pre>This will be appended to the output of the_content().</pre>';
	
	return $content;
}
?>