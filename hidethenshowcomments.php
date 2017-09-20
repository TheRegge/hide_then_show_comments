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


// Remove 'comments' link from admin bar:
function remove_admin_bar_menus($wp_admin_bar){
	$wp_admin_bar->remove_node('comments');
}

// Remove comments menu page
function remove_menus() {
    global $menu;
    remove_menu_page( 'edit-comments.php' );
}

// Hide comments before user has posted at
// least one comment for the post
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

function apply_restrictions() {
    if (! current_user_can('moderate_comments')) {
        add_action('admin_bar_menu', 'remove_admin_bar_menus', 999);
        add_action( 'admin_init', 'remove_menus', 999 );
        add_action( 'the_post', 'check_and_hide_comments');
    }
}
add_action('init', apply_restrictions);