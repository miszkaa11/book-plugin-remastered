<?php
/*
 * Add my new menu to the Admin Control Panel
 */

// Hook the 'admin_menu' action hook, run the function named 'mb_add_my_admin_link()'
add_action( 'admin_menu', 'mb_add_my_admin_link' );

// Add a new top level menu link to the ACP
function mb_add_my_admin_link()
{
      add_menu_page(
        'Book Page', // Title of the page
        'My Book &#128366;', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'book-plugin-main/includes/mb-first-acp-page.php' // The 'slug' - file to display when clicking the link
    );
}

// Access to the PHP files
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register Custom Post Type
function register_book_post_type() {
    $labels = [
        'name'               => __( 'Books', 'text-domain' ), // General name for the post type
        'singular_name'      => __( 'Book', 'text-domain' ) // Name for one object of this post type
    ];

    $supports = [ 'title', 'thumbnail', 'editor' ];

    $args = [
        'labels'              => $labels, // Labels for the post type
        'description'         => __( 'book post', 'text-domain' ), // Description
        'public'              => true, // Control the visibility of this post type
        'show_in_rest'        => true,
        'has_archive'         => true, // Whether this post type has an archive
        'rewrite'             => [ 'slug' => 'book' ], // Slug for posts of this type
        'supports'            => $supports
    ];

    register_post_type( 'book', $args );
}

add_action( 'init', 'register_book_post_type' );

// Register ACF fields
function custom_books_register_fields() {
    if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group([
            'key' => 'group_books',
            'title' => 'Book Fields',
            'fields' => [
                [
                    'key' => 'fld_author',
                    'label' => 'Author',
                    'name' => 'author',
                    'type' => 'text',
                ],
                [
                    'key' => 'fld_year',
                    'label' => 'Year',
                    'name' => 'year',
                    'type' => 'number',
                ],
                [
                    'key' => 'fld_genre',
                    'label' => 'Genre',
                    'name' => 'genre',
                    'type' => 'text',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'book',
                    ],
                ],
            ],
        ]);

    endif;
}
add_action('acf/init', 'custom_books_register_fields');

// Register custom templates
function custom_books_register_templates($templates) {
    $templates['single-book.php'] = 'Single Book';
    $templates['archive-book.php'] = 'Book Archive';
    return $templates;
}
add_filter('theme_page_templates', 'custom_books_register_templates');

// Connect CPT
function custom_book_templates($template) {
    global $post;

    if ($post->post_type == 'book') {
        if (is_single()) {
            $template = MY_BOOK_PLUGIN_PATH . '/templates/single-book.php';
        } elseif (is_archive()) {
            $template = MY_BOOK_PLUGIN_PATH . '/templates/archive-book.php';
        }
    }

    return $template;
}
add_filter('template_include', 'custom_book_templates');


// Enqueue styles and scripts
// Admin
function custom_books_enqueue_scripts() {
        wp_enqueue_style('custom-books-style', MY_BOOK_PLUGIN_URL . 'assets/css/main.css');
        wp_enqueue_script('custom-books-script', MY_BOOK_PLUGIN_URL . 'assets/js/scripts.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'custom_books_enqueue_scripts');

// Front
function custom_books_enqueue_scripts_2() {
  wp_enqueue_style('custom-books-style', MY_BOOK_PLUGIN_URL . 'assets/css/main.css');
  wp_enqueue_script('custom-books-script', MY_BOOK_PLUGIN_URL . 'assets/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'custom_books_enqueue_scripts_2');
