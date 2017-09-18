<?php
/**
 * @package Hide_Then_Show_Comments
 * @version 0.1
 */
/*
Plugin Name: Hide Then Show Comments
Plugin URI: 
Description: Only show comments of a post after user posts a comment.
Author: Regis Zaleman
Version: 0.1
Author URI: https://blogs.dalton.org/technofrench
*/

add_action( 'the_post', 'check_and_hide_comments');

function check_and_hide_comments() {
    global $post;

    $args = array(
        'user_id' => get_current_user_id(),
        'post_id' => $post->ID
    );
    $user_comments = get_comments($args);
    $user_comments_num = count($user_comments);

    if ( $user_comments_num < 1 ) {
        add_filter( 'comments_template', 'change_comments_template' ) ;
    }
}

function change_comments_template() {
    return plugin_dir_path( __FILE__ ) . 'template-comments.php';
}