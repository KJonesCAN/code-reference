<?php
global $wpdb;

/* Get results */

$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}options WHERE option_id = 1", OBJECT);

/* Select a row */

$mylink = $wpdb->get_row("SELECT * FROM $wpdb->links WHERE link_id = 10");

echo $mylink->link_id; // prints "10"

/* INSERT a row */

$wpdb->insert(
    'table', 
    array(
        'column1' => 'value1', 
        'column2' => 123, 
   ), 
    array(
        '%s', 
        '%d', 
   ) 
);

/* UPDATE a row */

$wpdb->update(
    'table', 
    array(
        'column1' => 'value1',   // string
        'column2' => 'value2'    // integer (number) 
   ), 
    array('ID' => 1), 
    array(
        '%s',   // value1
        '%d'    // value2
   ), 
    array('%d') 
);

/* DELETE a row */

$wpdb->delete('table', array('ID' => 1));
?>