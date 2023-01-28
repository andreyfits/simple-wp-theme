<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                        </div>
                        <div class="card-body">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail() ?>
                            <?php endif; ?>
                            <p class="card-text"><?php the_excerpt() ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="<?php the_permalink() ?>" class="btn btn-primary">Read</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
                <?php the_posts_pagination(array(
                    'show_all' => false,
                    'mid_size' => 2,
                    'end_size' => 1,
                    'type'     => 'list'
                )); ?>
            <?php else : ?>
                <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
        </div>
    </div>

<?php get_footer() ?>