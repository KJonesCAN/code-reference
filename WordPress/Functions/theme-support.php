<?php
/* Images */

add_theme_support('custom-logo');
add_theme_support('post-thumbnails');

/* Block Alignment */

add_theme_support('align-wide');

/* Post Formats */

function themename_post_formats_setup() {
    add_theme_support('post-formats', array('aside', 'gallery'));
}

add_action('after_setup_theme', 'themename_post_formats_setup');

/* Editor Styles */

add_theme_support('editor-styles');
add_editor_style('css/editor-style.css');

/* Custom Color Palette */

function kjca_color_palette() {
	add_theme_support('editor-color-palette', array(
		array(
			'name'  => __('Primary', 'kjca'),
			'slug'  => 'primary',
			'color'	=> '#13658f',
		),
		array(
			'name'  => __('Primary (lighter)', 'kjca'),
			'slug'  => 'primary-lighter',
			'color'	=> '#54a2c9',
		),
		array(
			'name'  => __('Primary (darker)', 'kjca'),
			'slug'  => 'primary-darker',
			'color'	=> '#105679',
		),
		array(
			'name'  => __('Secondary', 'kjca'),
			'slug'  => 'secondary',
			'color'	=> '#020e14',
		),
		array(
			'name'  => __('Tertiary', 'kjca'),
			'slug'  => 'tertiary',
			'color'	=> '#acc6d2',
		),
		array(
			'name'  => __('Black', 'kjca'),
			'slug'  => 'black',
			'color' => '#000000',
		),
		array(
			'name'  => __('Dark Grey', 'kjca'),
			'slug'  => 'dark-grey',
			'color' => '#444444',
		),
		array(
			'name'  => __('Grey', 'kjca'),
			'slug'  => 'grey',
			'color' => '#dddddd',
		),
		array(
			'name'  => __('Light Grey', 'kjca'),
			'slug'  => 'light-grey',
			'color' => '#ededed',
		),
		array(
			'name'	=> __('White', 'kjca'),
			'slug'	=> 'white',
			'color'	=> '#ffffff',
		),
	));
}

add_action('after_setup_theme', 'kjca_color_palette');

/* Custom Font Sizes */

function kjca_editor_font_sizes() {
	add_theme_support('disable-custom-font-sizes');

	add_theme_support('editor-font-sizes', array(
		array(
			'name'  => __('Small', 'kjca'),
			'color'	=> 12,
			'slug'  => 'small'
		),
		array(
			'name'  => __('Medium', 'kjca'),
			'color'	=> 18,
			'slug'  => 'medium'
		),
		array(
			'name'  => __('Large', 'kjca'),
			'color'	=> 36,
			'slug'  => 'large'
		),
		array(
			'name'  => __('Extra Large', 'kjca'),
			'color'	=> 42,
			'slug'  => 'x-large'
		)
	));
}

add_action('after_setup_theme', 'kjca_editor_font_sizes');
?>