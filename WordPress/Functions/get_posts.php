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

$posts = get_posts($args);
?>