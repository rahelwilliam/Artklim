<?php

/**
 * Theme general setup
 */
function theme_setup() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_filter( 'use_default_gallery_style', '__return_false' );
    add_filter( 'show_admin_bar', '__return_false' );
}
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Register Navigation Menus
 */
function custom_navigation_menus() {
    register_nav_menus( array(
        'main_menu' => __( 'Main menu', 'wordpress-starter-template' ),
    ) );
}
add_action( 'init', 'custom_navigation_menus' );

/**
 * Remove file accents on upload
 */
if ( is_admin() ) {
    function wp_rauf_check_filetype_and_ext($wp_filetype, $file, $filename, $mimes) {
        if ( !$wp_filetype['proper_filename'] ) {
            $wp_filetype['proper_filename'] = remove_accents(str_replace('.'.$wp_filetype['ext'], '', $filename)).'.'.$wp_filetype['ext'];
        }
        return $wp_filetype;
    }
    add_filter( 'wp_check_filetype_and_ext', 'wp_rauf_check_filetype_and_ext', 10, 4 );
}

/**
 * Disable Contact Form 7 from automatically adding paragraphs to form
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * ACF Options Page
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page('Opções do Tema');	
}

// Start custom logotipo login admin
/**
 * Custom link logotipo admin for link website
 */
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

/**
 * Custom name logotipo admin
 */
function my_login_logo_url_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
// End custom logotipo login admin

// Start custom image column admin
/**
 * Add featured image in column posts list
*/
if (function_exists('add_theme_support')) {
    add_image_size('admin-thumb', 100, 100); // 100 pixels de largura (e altura ilimitada)
}
  
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
  
function posts_columns($defaults) {
    $defaults['my_post_thumbs'] = __('Imagem'); //Modifique o nome para o que desejar
    return $defaults;
}
  
function posts_custom_columns($column_name, $id) {
    if ($column_name === 'my_post_thumbs') {
        echo the_post_thumbnail('admin-thumb');
    }
}
// End custom image column admin


