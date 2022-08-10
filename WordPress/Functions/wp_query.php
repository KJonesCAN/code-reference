<?php
$args = array(
    'post_type' => 'post',
    'numberposts' => 5,
    'category' => 0,
    'orderby' => 'date',
    'order' => 'DESC',
    'include' => array(),
    'exclude' => array(),
    'meta_query' => array(
        array(
            'key' => 'meta_key',
            'value' => 'meta_value',
            'compare' => 'LIKE'
       )
    ),
    'suppress_filters' => true,
);

$the_query = new WP_Query($args);
 
if ($the_query->have_posts()) {
    echo '<ul>';

    while ($the_query->have_posts()) {
        $the_query->the_post();
        echo '<li>' . get_the_title() . '</li>';
    }

    echo '</ul>';
} else {
    // no posts found
}

wp_reset_postdata();
?>