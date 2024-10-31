<?php
/**
 * Plugin Name:  Tanvir Widget APIS plugin
 */


add_action( 'wp_dashboard_setup', 'tanvir_dashboard_widget' );
function tanvir_dashboard_widget(){
   wp_add_dashboard_widget(
       'tanvir_dashboard_widget',
       'Tanvir Dashboard Widget',
       'tanvir_dashboard_widget_callback',
       'tanvir_dashboard_widget_control',
   );
}

function tanvir_dashboard_widget_callback(){
    $numberOfPosts = get_option( 'tanvir_dashboard_widget_number_posts', 5);
    $args = array(
        'numberposts'   => $numberOfPosts,
        'post_status'   => 'publish'
    );

   $recent_posts =  wp_get_recent_posts( $args );

   echo '<ul>';
    foreach ( $recent_posts as $recent_post ){
        echo '<li><a href=" ' . get_permalink($recent_post["ID"]) . '"> ' . $recent_post["post_title"] . '</a> </li>';
    }
   echo '</ul>';
}

function tanvir_dashboard_widget_control(){
    if( isset( $_POST['tanvir_dashboard_widget_number_posts'] ) ){
        $numberOfPosts = sanitize_text_field( $_POST['tanvir_dashboard_widget_number_posts'] );
        update_option( 'tanvir_dashboard_widget_number_posts', $numberOfPosts );
    }
        $numberOfPosts = get_option( 'tanvir_dashboard_widget_number_posts', 5);
        echo '<label>Enter The number of posts to display</label>';
        echo '<input type="text" name="tanvir_dashboard_widget_number_posts"  value="'. $numberOfPosts .'" />';
}