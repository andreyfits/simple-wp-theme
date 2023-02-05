<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
        </div>
        <div class="card-body">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail() ?>
            <?php endif; ?>
            <?php simple_theme_entry_meta_footer(); ?>
            <p class="card-text"><?php the_excerpt() ?></p>
        </div>
        <div class="card-footer">
            <a href="<?php the_permalink() ?>" class="btn btn-primary"><?php _e('Read more', 'simple-theme'); ?></a>
        </div>
    </div>
</div>