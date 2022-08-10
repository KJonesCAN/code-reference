<?php
// Add custom meta boxes

add_action('add_meta_boxes', 'kj_add_custom_metaboxes');

function kj_add_custom_metaboxes() {
	add_meta_box('kj_custom_meta', 'Custom Metabox Title', 'kj_custom_meta', 'page', 'normal', 'high');
}

// Add source information to posts

function kj_custom_meta() {
	global $post;
	
	echo '<input type="hidden" name="kj_custom_meta_nonce" id="kj_custom_meta_nonce" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
	
	$custom_meta = get_post_meta($post->ID, 'custom_meta_key', true);
	
	echo '
        <label>Custom Meta Field</label><br />
        <input type="text" name="custom_meta_key" value="' . $custom_meta  . '" />
    ';
}

// Save the Metabox Data

function kj_save_custom_meta($post_id, $post) {
	if (!wp_verify_nonce($_POST['kj_custom_meta_nonce'], plugin_basename(__FILE__))) {
		return $post->ID;
	}

	if (!current_user_can('edit_post', $post->ID)) {
        return $post->ID;
    }

	$custom_meta['custom_meta_key'] = $_POST['custom_meta_key'];

	foreach ($custom_meta as $key => $value) { 
		if ($post->post_type == 'revision') return;

		$value = implode(',', (array)$value);

		if (get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}

		if (!$value) delete_post_meta($post->ID, $key);
	}
}

add_action('save_post', 'kj_save_custom_meta', 1, 2);
?>