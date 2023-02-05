<?php

/*
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'simple_theme_scripts' ) ) :
	function simple_theme_scripts(): void {
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

		wp_enqueue_script(
			'simple-theme-js',
			get_template_directory_uri() . '/assets/js/script.js',
			array(),
			true,
			true
		);
	}
endif;

add_action( 'wp_enqueue_scripts', 'simple_theme_scripts' );

if ( ! function_exists( 'simple_theme_setup' ) ) :
	function simple_theme_setup() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		set_post_thumbnail_size( 300, 200 );
	}
endif;

add_action( 'after_setup_theme', 'simple_theme_setup' );

add_action( 'after_setup_theme', function(){
	load_theme_textdomain( 'simple-theme', get_template_directory() . '/languages' );
});

add_filter( 'navigation_markup_template', 'simple_theme_navigation_template', 10, 2 );

if ( ! function_exists( 'simple_theme_navigation_template' ) ) :

	function simple_theme_navigation_template( $template, $class ) {
		return '
	<nav class="navigation" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
	}
endif;

if ( ! function_exists( 'simple_theme_entry_meta_footer' ) ) :
	function simple_theme_entry_meta_footer() {

		if ( ! is_single() ) {

			if ( has_category() || has_tag() ) {

				echo '<div>';

				$categoriesList = get_the_category_list( wp_get_list_item_separator() );
				if ( $categoriesList ) {
					printf(
						'<span>' . esc_html__( 'Categorized as %s', 'simpletheme' ) . ' </span>',
						$categoriesList
					);
				}
			}
		} else {

			if ( has_category() ) {

				echo '<div>';

				$categoriesList = get_the_category_list( wp_get_list_item_separator() );
				if ( $categoriesList ) {
					printf(
						'<span>' . esc_html__( 'Categorized as %s', 'simpletheme' ) . ' </span>',
						$categoriesList
					);
				}

				echo '</div>';
			}
		}
	}
endif;

if ( ! function_exists( 'filter_posts' ) ) :
	function filter_posts() {
		$postType     = $_POST['type'];
		$categorySlug = $_POST['category'];

		$posts = new WP_Query( [
			'post_type'      => $postType,
			'posts_per_page' => - 1,
			'category_name'  => $categorySlug,
			'order_by'       => 'date',
			'order'          => 'desc',
		] );

		$response = '';

		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) : $posts->the_post();
				$response .= get_template_part( 'template-parts/post' );
			endwhile;
		} else {
			$response = 'empty';
		}

		echo $response;
		exit;
	}
endif;

add_action( 'wp_ajax_filter_posts', 'filter_posts' );
add_action( 'wp_ajax_nopriv_filter_posts', 'filter_posts' );
