<?php get_header(); ?>
<?php include('inc/slider.php'); ?>
<div class="container">
    <div class="search-panel">
		<?php echo get_search_form(); ?>
    </div>
</div>
<div class="container">
    <?php the_breadcrumb(); ?>
    <h2 class="title is-3">
        <?php //echo get_search_string($wp_query); ?>
        <?php //get_template_part('parts/toggle', 'search'); ?>
    </h2>
    <?php //pr($wp_query) ?>

    <div class="columns">
        <div class="column is-three-quarters">
        <?php if (have_posts()) : ?>
            <div class="columns is-same-height is-multiline">
            <?php while (have_posts()) : the_post(); ?>
                <div class="column is-6">
                    <?php get_template_part('parts/post','loop') ?>
                </div>
            <?php endwhile; ?>
            </div>
        <?php else : ?>
            <?php include('inc/notfound.php') ?>
        <?php endif; ?>
        <?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

        </div>
        <div class="column is-one-quarter">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
