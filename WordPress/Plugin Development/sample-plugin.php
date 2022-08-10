<?php
/*
Plugin Name: Kelly's Plugin
Description: Creates a WordPress plugin.
Version: 1.0
Author: Kelly Jones
Author URI: https://kellyjones.ca
*/

// Enqueue JS and CSS

add_action('admin_enqueue_scripts', 'kjca_slideshows_admin_enqueue');
add_action('wp_enqueue_scripts', 'kjca_slideshows_enqueue');

function kjca_slideshows_admin_enqueue() {
	wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css');

    wp_enqueue_style('kjca_slideshows_admin_style', plugins_url('/admin/css/kjca-slideshows-admin.css', __FILE__));
    wp_enqueue_script('kjca_slideshows_admin_script', plugins_url('/admin/js/kjca-slideshows-admin.js', __FILE__), array(), '1.0.0', true);

    wp_enqueue_script('jquery-ui-datepicker', array('jquery'));
    wp_register_style('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css');
    wp_enqueue_style('jquery-ui');

    wp_enqueue_script('jquery-ui-sortable');

    wp_enqueue_media();
}

function kjca_slideshows_enqueue() {
    wp_enqueue_script('jquery');
	wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css');
	wp_enqueue_style('kjca_slideshows_style', plugins_url('/css/kjca-slideshows.css', __FILE__));
	wp_enqueue_style('slick_style', plugins_url('/css/slick.css', __FILE__));
    wp_enqueue_script('slick', plugins_url('js/slick.min.js', __FILE__), array(), null, true);
}

// Custom image sizes

add_image_size('kjca_slideshows_slide', 1800, 699, true);

// Register Custom Post Types

add_action('init', 'kjca_create_slideshow_post_types');

function kjca_create_slideshow_post_types() {
	register_post_type('slideshow',
		array(
            'labels' => array (
                'menu_name' => __('Slideshows'),
                'name' => __('Slideshows'),
                'all_items' => __('Slideshows'),
                'singular_name' => __('Slideshow')
            ),
            'menu_icon' => 'dashicons-images-alt2',
            'hierarchical' => false,
            'public' => true,
            'exclude_from_search' => true, 
            'show_ui' => true,
            'show_in_admin_bar' => true,
            'has_archive' => false,
            'capability_type' => 'page',
            'supports' => array('title')
        )
    );
}

// Add custom meta boxes

add_action('add_meta_boxes', 'kjca_add_slideshow_metaboxes');

function kjca_add_slideshow_metaboxes() {
    global $post;

    $slideshow_id = get_post_meta($post->ID, '_slideshow_id', true);

    add_meta_box('kjca_slideshow_overlay_meta', 'Slideshow Overlay', 'kjca_slideshow_overlay_meta', 'slideshow', 'normal', 'default');
    add_meta_box('kjca_slideshow_slides_meta', 'Slides', 'kjca_slideshow_slides_meta', 'slideshow', 'normal', 'default');
    add_meta_box('kjca_slideshow_settings_meta', 'Slideshow Settings', 'kjca_slideshow_settings_meta', 'slideshow', 'side', 'default');

    if ($post->post_status == 'publish' && $slideshow_id) {
        add_meta_box('kjca_slideshow_shortcode_meta', 'Shortcode', 'kjca_slideshow_shortcode_meta', 'slideshow', 'side', 'high');
    }
}

function kjca_slideshow_overlay_meta() {
	global $post;
	
	echo '<input type="hidden" name="kjca_slideshow_meta_noncename" id="kjca_slideshow_meta_noncename" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    
    $overlay_text = get_post_meta($post->ID, 'overlay_text', true);
    $editor_id = 'overlay_text';

    $settings = array(
        'editor_height' => 100
    );

    echo '
        <div class="slideshow-overlay-text">
    ';

    wp_editor($overlay_text, $editor_id, $settings);

    echo '
        </div>
    ';
}

function kjca_slideshow_slides_meta() {
	global $post;

    $slides_json = get_post_meta($post->ID, 'slides', true);

    if ($slides_json) {
        $slides = json_decode($slides_json, true);
    } else {
        $slides = false;
    }

    $editor_settings = array(
        'media_buttons' => false,
        'editor_height' => 200,
    );

    $editor_id = 'temp-caption';

    echo '
        <div class="admin-slides-buttons">
            <button class="add-slide button button-primary" data-field="file-src"><span class="dashicons dashicons-plus"></span> Add Slide</button>
        </div>

        <div id="temp-slide-data" class="slides">
            <div class="slide">
                <div class="slide-title"></div>
                <div class="slide-preview">
                    <div class="preview-image"></div>
                    <div class="file-details">
                        <span class="filename"></span>
                        <span class="filesize"></span>
                    </div>
                    <div class="dimensions">
                        <span class="width"></span> x <span class="height"></span>
                    </div>
                </div>
                <div class="slide-buttons">
                    <a class="button button-secondary delete-slide" href="javascript:void(0);" title="Delete this slide" onClick="confirm(\'Are you sure?\');"><i class="fas fa-trash"></i></a>
                </div>
                <div class="slide-details">
                    <input class="id" type="hidden" value="" readonly />
                    <input class="src" type="hidden" value="" readonly />
                    <input class="filename" type="hidden" value="" readonly />
                    <input class="filesize" type="hidden" value="" readonly />
                    <input class="width" type="hidden" value="" readonly />
                    <input class="height" type="hidden" value="" readonly />

                    <div class="slide-caption">
                        <textarea class="caption wp-editor-area" rows="10"></textarea>
                    </div>
                    <div class="slide-alt">
                        <label>Alt. Text</label>
                        <input class="alt widefat" type="text" value="" />
                    </div>
                    <div class="slide-link">
                        <label>Link</label>
                        <input class="link widefat" type="text" value="" /><br />
                        <input class="target" type="checkbox" value="_blank" /> Open in new tab
                    </div>
                    <div class="slide-schedule">
                        <h3>Schedule</h3>
                        <div class="slide-start-date">
                            <label>Start</label>
                            <input class="start-date" type="text" value="' . date('Y-m-d') . '" /><br />
                        </div>
                        <div class="slide-expire-date">
                            <label>Expiration Date</label>
                            <input class="expire-date" type="text" value="" /><br />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="slides" class="slides">
    ';

    if ($slides) {
        $slide_count = 0;

        foreach ($slides as $slide) {
            $attachment_id = $slide['id'];
            $enabled = $slide['enabled'];
            $src = $slide['src'];
            $width = $slide['width'];
            $height = $slide['height'];
            $filename = $slide['filename'];
            $filesize = $slide['filesize'];
            $alt = $slide['alt'];
            $link = $slide['link'];
            $target = $slide['target'];
            $start_date = $slide['start_date'];
            $expire_date = $slide['expire_date'];
            $caption = $slide['caption'];
            $caption = stripslashes($caption);

            if (!$start_date) {
                $start_date = date('Y-m-d');
            }

            if ($enabled == 1) {
                $slided_enabled_checked = ' checked ';
                $slide_toggle_class = 'slide-toggle enabled';
                $slide_toggle_title = 'Slide is enabled';
            } else {
                $slided_enabled_checked = ' ';
                $slide_toggle_class = 'slide-toggle';
                $slide_toggle_title = 'Slide is disabled';
            }

            if ($target == '_blank') {
                $link_target_checked = ' checked ';
            } else {
                $link_target_checked = ' ';
            }

            if ($src) {
                echo '
                    <div class="slide">
                        <div class="slide-title">Slide ' . ($slide_count + 1) . '</div>
                        <div class="slide-settings">
                            <div class="slide-preview">
                                <div class="preview-image">
                                    <img src="' . $src . '" width="' . $width . '" height="' . $height . '" alt="' . $alt . '" />
                                </div>
                                <div class="file-details">
                                    <span class="filename">' . $filename . '</span>
                                    <span class="filesize">' . $filesize . '</span>
                                    <div class="dimensions">
                                        <span class="width">' . $width . '</span> x <span class="height">' . $height . '</span>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-toggles">
                                <div>
                                    <div class="' . $slide_toggle_class . '" title="' . $slide_toggle_title . '">
                                        <div class="switch"></div>
                                        <input' . $slided_enabled_checked . 'class="slide-toggle-checkbox" type="checkbox" name="slide[' . $slide_count . '][enabled]" value="1" />
                                    </div>
                                </div>
                            </div>
                            <div class="slide-details">
                                <input class="id" type="hidden" name="slide[' . $slide_count . '][id]" value="' . $attachment_id . '" readonly />
                                <input class="src widefat" type="hidden" name="slide[' . $slide_count . '][src]" value="' . $src . '" readonly />
                                <input class="filename" type="hidden" name="slide[' . $slide_count . '][filename]" value="' . $filename . '" readonly />
                                <input class="filesize" type="hidden" name="slide[' . $slide_count . '][filesize]" value="' . $filesize . '" readonly />
                                <input class="width" type="hidden" name="slide[' . $slide_count . '][width]" value="' . $width . '" readonly />
                                <input class="height" type="hidden" name="slide[' . $slide_count . '][height]" value="' . $height . '" readonly />

                                <div class="slide-caption">
                ';

                $editor_id = 'caption-' . $slide_count;

                wp_editor($caption, $editor_id, $editor_settings);

                echo '
                                </div>
                                <div class="slide-alt">
                                    <label>Alt. Text</label>
                                    <input class="alt widefat" type="text" name="slide[' . $slide_count . '][alt]" value="' . $alt . '" />
                                </div>
                                <div class="slide-link">
                                    <label>Link</label>
                                    <input class="link widefat" type="text" name="slide[' . $slide_count . '][link]" value="' . $link . '" /><br />
                                    <input' . $link_target_checked . 'class="target" type="checkbox" name="slide[' . $slide_count . '][target]" value="_blank" /> Open in new tab
                                </div>
                                <div class="slide-schedule">
                                    <h3>Schedule</h3>
                                    <div class="slide-start-date">
                                        <label>Start Date</label>
                                        <input class="datepicker start-date" type="text" name="slide[' . $slide_count . '][start_date]" value="' . $start_date . '" /><br />
                                    </div>
                                    <div class="slide-expire-date">
                                        <label>Expiration Date</label>
                                        <input class="datepicker expiration-date" type="text" name="slide[' . $slide_count . '][expire_date]" value="' . $expire_date . '" /><br />
                                    </div>
                                </div>
                            </div>
                            <div class="slide-buttons">
                                <div class="text-right">
                                    <a class="button button-secondary delete-slide" href="javascript:void(0);" title="Delete this slide" onClick="confirm(\'Are you sure?\');"><i class="fas fa-trash"></i> Delete Slide</a>
                                </div>
                            </div>
                        </div>
                        <div class="expand-slide" title="Click to expand"><i class="fas fa-angle-down"></i></div>
                        <div class="collapse-slide" title="Click to collapse"><i class="fas fa-angle-up"></i></div>
                    </div>
                ';

                $slide_count++;
            }
        }
    }

    echo '
        </div>
    ';
}

function kjca_slideshow_shortcode_meta() {
    global $post;

    $slideshow_id = get_post_meta($post->ID, '_slideshow_id', true);

    echo '
        <input class="widefat" type="text" value="[slideshow id=&quot;' . $slideshow_id . '&quot;]" readonly />
    ';
}

function kjca_slideshow_settings_meta() {
    global $post;

    $animations = array(
        'fade' => 'Fade',
        'slide' => 'Slide'
    );

    $animation = get_post_meta($post->ID, 'animation', true);
    $animation_speed = get_post_meta($post->ID, 'animation_speed', true);
    $autoplay = get_post_meta($post->ID, 'autoplay', true);
    $autoplay_speed = get_post_meta($post->ID, 'autoplay_speed', true);
    $arrows = get_post_meta($post->ID, 'arrows', true);
    $dots = get_post_meta($post->ID, 'dots', true);

    if (!$animation_speed) {
        $animation_speed = 500;
    }

    if ($autoplay == 1) {
        $autoplay_checked = ' checked ';
    } else {
        $autoplay_checked = ' ';
    }

    if (!$autoplay_speed) {
        $autoplay_speed = 8000;
    }

    if ($arrows == 1) {
        $arrows_checked = ' checked ';
    } else {
        $arrows_checked = ' ';
    }

    if ($dots == 1) {
        $dots_checked = ' checked ';
    } else {
        $dots_checked = ' ';
    }

    echo '
        <table class="slideshow-settings">
        <tr>
            <th class="animation">
                <label>Animation</label>
            </th>
            <td>
                <select name="slideshow_animation">
    ';

    foreach ($animations as $key => $value) {
        if ($animation == $key) {
            $selected = ' selected ';
        } else {
            $selected = ' ';
        }

        echo '
            <option' . $selected . 'value="' . $key . '">' . $value . '</option>
        ';
    }

    echo '
                </select>
            </td>
        </tr>
        <tr>
            <th>
                <label>Animation speed</label>
            </th>
            <td>
                <input class="animation-speed" type="text" name="slideshow_animation_speed" value="' . $animation_speed . '" />ms
            </td>
        </tr>
        <tr>
            <th class="autoplay">
                <label>Autoplay</label>
            </th>
            <td>
                <input' . $autoplay_checked . 'type="checkbox" name="slideshow_autoplay" value="1" />
            </td>
        </tr>
        <tr>
            <th>
                <label>Autoplay speed</label>
            </th>
            <td>
                <input class="autoplay-speed" type="text" name="slideshow_autoplay_speed" value="' . $autoplay_speed . '" />ms
            </td>
        </tr>
        <tr>
            <th class="arrows">
                <label>Show arrows</label>
            </th>
            <td>
                <input' . $arrows_checked . 'type="checkbox" name="slideshow_arrows" value="1" />
            </td>
        </tr>
        <tr>
            <th class="dots">
                <label>Show dots</label>
            </th>
            <td>
                <input' . $dots_checked . 'type="checkbox" name="slideshow_dots" value="1" />
            </td>
        </tr>
        </table>
    ';
}

// Save the metabox data

function kjca_save_slideshow_meta($post_id, $post) {
	if (!wp_verify_nonce($_POST['kjca_slideshow_meta_noncename'], plugin_basename(__FILE__))) {
		return $post->ID;
	}

	if (!current_user_can('edit_post', $post->ID)) {
        return $post->ID;
    }

    if ($_POST['slide']) {
        $slide_count = 0;

        foreach ($_POST['slide'] as $slide) {
            foreach ($slide as $key => $value) {
                if ($key == 'caption') {
                    $caption = str_replace("\r\n", '<br>', $value);
                    $slides[$slide_count][$key] = addslashes($caption);
                } else {
                    $slides[$slide_count][$key] = $value;
                }
            }

            $slide_count++;
        }
        
        $slideshow_meta['slides'] = json_encode($slides, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
    } else {
        $slideshow_meta['slides'] = null;
    }

    $slideshow_id = get_post_meta($post->ID, '_slideshow_id', true);

    if (!$slideshow_id) {
        $slideshow_count = get_option('kjca_slideshow_count');
    
        if ($slideshow_count) {
            $slideshow_id = (int)$slideshow_count + 1;
        } else {
            $slideshow_id = 1;    
        }

        update_option('kjca_slideshow_count', $slideshow_id, true);
    }
    
    // Slideshow settings

    $slideshow_meta['overlay_text'] = $_POST['overlay_text'];
    $slideshow_meta['animation'] = $_POST['slideshow_animation'];
    $slideshow_meta['animation_speed'] = $_POST['slideshow_animation_speed'];
    $slideshow_meta['autoplay'] = $_POST['slideshow_autoplay'];
    $slideshow_meta['autoplay_speed'] = $_POST['slideshow_autoplay_speed'];
    $slideshow_meta['arrows'] = $_POST['slideshow_arrows'];
    $slideshow_meta['dots'] = $_POST['slideshow_dots'];

    // Slides

	$slideshow_meta['_slideshow_id'] = $slideshow_id;

	foreach ($slideshow_meta as $key => $value) { 
        if ($post->post_type == 'revision') return;
        
        $value = implode(',', (array)$value);
        
		if (get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
        }
        
        if (!$value) delete_post_meta($post->ID, $key);
        
        update_post_meta($post->ID, 'caption', $_POST['caption-' . $count]);
    }
}

add_action('save_post', 'kjca_save_slideshow_meta', 1, 2);

// Display slideshow

function kjca_display_slideshow($post_id = NULL) {
    $output = false;

    if ($post_id) {
        $slideshow_id = get_post_meta($post_id, '_slideshow_id', true);
        $slideshow_name = get_post_field('post_name', $post_id);

        $slides_json = get_post_meta($post_id, 'slides', true);

        if ($slides_json) {
            $slides = json_decode($slides_json, true);
        } else {
            $slides = false;
        }

        if ($slides) {
            $overlay_text = get_post_meta($post_id, 'overlay_text', true);
            $animation = get_post_meta($post_id, 'animation', true);
            $animation_speed = get_post_meta($post_id, 'animation_speed', true);
            $autoplay = get_post_meta($post_id, 'autoplay', true);
            $autoplay_speed = get_post_meta($post_id, 'autoplay_speed', true);
            $arrows = get_post_meta($post_id, 'arrows', true);
            $dots = get_post_meta($post_id, 'dots', true);

            if ($overlay_text) {
                $slideshow_overlay = '
                    <div class="slideshow-overlay">
                        ' . apply_filters('the_content', $overlay_text) . '
                    </div>
                ';
            } else {
                $slideshow_overlay = '';
            }

            if ($animation == 'fade') {
                $fade = 'true';
            } else {
                $fade = 'false';
            }

            if (!$animation_speed || !is_numeric($animation_speed)) {
                $animation_speed = 500;
            }

            if ($autoplay == 1) {
                $autoplay = 'true';
            } else {
                $autoplay = 'false';
            }

            if (!$autoplay_speed || !is_numeric($autoplay_speed)) {
                $autoplay_speed = 8000;
            }

            if ($arrows == 1) {
                $arrows = 'true';
            } else {
                $arrows = 'false';
            }

            if ($dots == 1) {
                $dots = 'true';
            } else {
                $dots = 'false';
            }
        
            $output = '
                <div class="slideshow-wrapper">
                    ' . $slideshow_overlay . '
                    <div class="slideshow slideshow-' . $slideshow_name . '  slideshow-' . $slideshow_id . '">
            ';

            foreach ($slides as $slide) {
                $slide_id = $slide['id'];
                $enabled = $slide['enabled'];
                $src = $slide['src'];
                $width = $slide['width'];
                $height = $slide['height'];
                $alt = $slide['alt'];
                $link = $slide['link'];
                $target = $slide['target'];
                $start_date = $slide['start_date'];
                $expire_date = $slide['expire_date'];
                $now = strtotime(date('Y-m-d H:i:s'));
                $start_date_passed = false;
                $expire_date_passed = false;

                if (!$start_date || (strtotime($start_date) <= $now)) { 
                    $start_date_passed = true;
                }

                if ($expire_date) {
                    if (strtotime($expire_date) > $now) {
                        $expire_date_passed = true;
                    }
                } else {
                    $expire_date_passed = true;
                }

                if ($src && $enabled == 1 && $start_date_passed && $expire_date_passed) {
                    $image = '<img src="' . $src . '" width="' . $width . '" height="' . $height . '" alt="' . $alt . '" />';

                    if ($slide['caption']) {
                        $caption_text = wpautop($slide['caption']);
                        $caption = '<div class="caption">' . apply_filters('the_content', stripslashes($caption_text)) . '</div>';
                    } else {
                        $caption = '';
                    }

                    if ($link) {
                        if (!$target) {
                            $target = '_self';
                        }

                        $output .= '
                            <a class="slide slide-' . $slide_id . '" href="' . $link . '" target="' . $target . '">' 
                                . $caption 
                                . $image . 
                            '</a>
                        ';
                    } else {
                        $output .= '
                            <div class="slide slide-' . $slide_id . '">' 
                                . $caption 
                                . $image . 
                            '</div>
                        ';
                    }
                }
            }

            $output .= '
                    </div>
                </div>

                <script>
                    jQuery(document).ready(function() {
                        jQuery(".slideshow-wrapper").css("visibility", "visible");

                        jQuery(".slideshow-' . $slideshow_id . '").slick({
                            adaptiveHeight: false,
                            lazyLoad: \'ondemand\',
                            infinite: true, 
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            autoplay: ' . $autoplay . ',
                            fade: ' . $fade . ',
                            cssEase: \'linear\',
                            dots: ' . $dots . ',
                            arrows: ' . $arrows . ',
                            speed: ' . $animation_speed . ',
                            autoplaySpeed: ' . $autoplay_speed . ',
                            vertical: false,
                            prevArrow: \'<button class="slick-prev"><i class="fas fa-chevron-left"></i></button>\',
                            nextArrow: \'<button class="slick-next"><i class="fas fa-chevron-right"></i></button>\',
                            customPaging: function(slider, i) {
                                return \'\';
                            }
                        });
                    });
                </script>
            ';
        }
    }

    return $output;
}

function kjca_slideshow_shortcode($atts) {
    $a = shortcode_atts(array(
		'id' => null
    ), $atts);

    $output = false;
    
    if ($a['id']) {
        $args = array(
            'post_type' => 'slideshow',           
            'meta_key' => '_slideshow_id',
            'meta_value' => $a['id']
        );

        $slideshow = get_posts($args);

        if ($slideshow) {
            $output = kjca_display_slideshow($slideshow[0]->ID);
        } else {
            $output = 'Failure';
        }
    }

    return $output;
}

add_shortcode('slideshow', 'kjca_slideshow_shortcode');

/* Recent News Slider */

function blog_post_slider () {
	$news = get_posts(
		array(
			'numberposts' => 5
		)
	);

	$output = false;

	if ($news) {
		$output = '
			<div class="post-slider wow fadeIn">
		';

		foreach ($news as $story) {
			$content = strip_tags($story->post_content);
			$excerpt = wp_trim_words($content, 55);

			$output .= '
				<div class="post-slide">
					<div class="post-content">
						<div class="post-details">
							<div class="post-date">' . date('F j, Y', strtotime($story->post_date)) . '</div>
							<h3 class="post-title"><a href="' . get_permalink($story->ID) . '">' . $story->post_title . '</a></h3>
							<div class="post-excerpt">
								' . $excerpt . '
							</div>
							<div class="wp-block-button more">
								<a class="wp-block-button__link" href="' . get_permalink($story->ID) . '"><span>Read More</span></a>
							</div>
						</div>
					</div>
					<div class="post-image">
			';

			if (has_post_thumbnail($story->ID)) {
				$output .= get_the_post_thumbnail($story->ID, 'large');
			}

			$output .= '
					</div>
				</div>
			';
		}

		$output .= '
			</div>

            <script>
                jQuery(document).ready(function() {
                    jQuery(\'.post-slider\').slick({
                        adaptiveHeight: false,
                        lazyLoad: \'ondemand\',
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1, 
                        prevArrow: \'<button class="slick-prev"><i class="fas fa-chevron-left"></i></button>\',
                        nextArrow: \'<button class="slick-next"><i class="fas fa-chevron-right"></i></button>\',
                    });
                });
			</script>
		';
	}

	return $output;
}

add_shortcode('post-slider', 'blog_post_slider');
?>