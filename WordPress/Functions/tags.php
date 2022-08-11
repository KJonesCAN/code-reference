<?php
function display_post_tags($post_id) {
	$tags = get_tags($post_id);
	
	if ($tags) {
		$output = '<ul class="post-tags">';
		
		foreach ($tags as $tag) {
			$output .= '<li class="post-tag"><a href="#">' . $tag->name . '</a>';
			
			$tag_posts = get_posts(
				array(
					'post_type' => 'post',
					'tag_id' => $tag->term_id,
					'number' => 3
				)
			);
			
			if ($tag_posts) {
				$output .= '<ul>';
				
				foreach ($tag_posts as $tag_post) {
					$output .= '
						<li class="tag_post">
							<a href="' . get_permalink($tag_post->ID) . '">' . $tag_post->post_title . '</a>
						</li>';
				}
				
				$output .= '</ul>';
			}
			
			$output .= '</li>';
		}
		
		$output .= '</ul>';
		
		return $output;
	}
	
	return false;
}
?>