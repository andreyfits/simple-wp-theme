<?php get_header(); ?>

<header><a href="<?php echo home_url() ?>"></a></header>
<?php home_url() ?>
<?php $categories = get_categories(); ?>
<ul class="category-list">
    <li><a class="category-list_item active" href="#!" data-slug="">All posts</a></li>

	<?php foreach ( $categories as $category ) : ?>
        <li>
            <a class="category-list_item" href="#!" data-slug="<?= $category->slug ?>" data-type="post">
				<?= $category->name ?>
            </a>
        </li>
	<?php endforeach; ?>
</ul>

<?php

$paged = ( get_query_var( 'paged' ) ) ?: 1;

$posts = new WP_Query( [
	'post_type' => 'post',
	'paged'     => $paged,
	'order_by'  => 'date',
	'order'     => 'desc'
] );

?>

<?php if ( $posts->have_posts() ): ?>
    <div class="container">
        <div class="row">
			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<?php get_template_part( 'template-parts/post' ); ?>
			<?php endwhile; ?>
			<?php the_posts_pagination( array(
				'show_all' => false,
				'mid_size' => 2,
				'end_size' => 1,
				'type'     => 'list'
			) ); ?>
        </div>
    </div>
	<?php wp_reset_postdata(); ?>
<?php else : ?>
    <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer() ?>

