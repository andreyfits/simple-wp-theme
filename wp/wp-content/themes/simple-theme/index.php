<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-md-12">
                    <div class="card">
                        <img src="" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                            <p class="card-text"><?php the_excerpt() ?></p>
                            <a href="<?php the_permalink() ?>" class="btn btn-primary">Read</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; else : ?>
                <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
        </div>
    </div>

<?php get_footer() ?>