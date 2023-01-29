<?php

/*
 * Enqueue scripts and styles.
 */
function simple_theme_scripts(): void
{
    wp_enqueue_style( 'simple-theme-bootstrapcss', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( 'simple-theme-style', get_stylesheet_uri() );

    wp_enqueue_script(
        'simple-theme-popper',
        '//cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js',
        array(),
        true,
        true
    );

    wp_enqueue_script(
        'simple-theme-bootstrapjs',
        get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
        array(),
        true,
        true
    );

    wp_enqueue_script(
        'simple-theme-jquery',
        '//ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js',
        array(),
        true,
        true
    );
}

add_action( 'wp_enqueue_scripts', 'simple_theme_scripts' );

function simple_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    set_post_thumbnail_size( 300, 200 );
}

add_action( 'after_setup_theme', 'simple_theme_setup' );

add_filter('navigation_markup_template', 'navigation_template', 10, 2 );
function navigation_template( $template, $class ){
    return '
	<nav class="navigation" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

function simple_theme_entry_meta_footer() {

    if ( ! is_single() ) {

        if ( has_category() || has_tag() ) {

            echo '<div>';

            $categories_list = get_the_category_list( wp_get_list_item_separator() );
            if ( $categories_list ) {
                printf(
                    '<span>' . esc_html__( 'Categorized as %s', 'simpletheme' ) . ' </span>',
                    $categories_list
                );
            }
        }
    } else {

        if ( has_category() ) {

            echo '<div>';

            $categories_list = get_the_category_list( wp_get_list_item_separator() );
            if ( $categories_list ) {
                printf(
                    '<span>' . esc_html__( 'Categorized as %s', 'simpletheme' ) . ' </span>',
                    $categories_list
                );
            }

            echo '</div>';
        }
    }
}
