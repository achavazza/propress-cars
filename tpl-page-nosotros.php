<?php
/*
Template Name: Nosotros + testimonios
*/
get_header();
?>
<?php


$reviews_title = get_post_meta( get_the_ID(), 'reviews_title', true );
$reviews = get_post_meta( get_the_ID(), 'cmb_reviews_metabox', true );


?>

<?php include('inc/slider.php'); ?>
<div class="container search-overlap">
    <div class="search-panel">
		<?php echo get_search_form(); ?>
    </div>
</div>
<div class="section">
<div class="container">
    <?php //the_breadcrumb(); ?>
	<div class="columns">
        <?php /*
		<div class="column is-three-quarters">
        */ ?>
        <div class="column">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post mb-6" id="post-<?php the_ID(); ?>">
                    <div class="block-title mb-4">
                        <h3 class="title is-4">
                            <?php the_title(); ?>
                        </h3>
                    </div>
                    <?php /*
					<h2 class="title is-primary is-3"><?php the_title(); ?></h2>
                    */ ?>
					<?php //include (TEMPLATEPATH . '/inc/meta.php' ); ?>
					<div class="entry">
						<?php the_content(); ?>
						<?php //wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
					</div>
					<?php //edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
				</div>
				<?php //comments_template(); ?>
			<?php endwhile; endif; ?>
			<?php include('inc/gallery.php'); ?>
		</div>
        <?php /*
		<div class="column is-one-quarter">
			<?php get_sidebar(); ?>
		</div>
        */ ?>
	</div>
</div>
</div>

<?php if($reviews): ?>
<div class="section">
<div class="container">
<div class="columns is-centered is-multiline">
    <div class="column">
    <div class="review-content">
        <?php
        if($reviews_title) {
            echo sprintf('<h3 class="title title-alt is-secondary has-text-centered is-4 py-4">%s</h3>', $reviews_title);
        }
        ?>
    <ul class="review-list columns is-centered is-multiline">
    <?php foreach($reviews as $review): ?>
        <li class="review column is-one-third">
            <div class="content has-text-centered">
                <?php // sprintf('<span>%s</span>', $review['review_value']); ?>
                <?= sprintf('<div class="text">%s</div>', wpautop($review['review_desc'])); ?>
            </div>
            <div class="user">
                <?= sprintf('<div class="picture image is-64x64 mb-3"><img class="is-rounded" src="%s" /></div>', $review['review_picture']); ?>
                <?= sprintf('<div class="name">%s</div>', $review['review_name']); ?>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
    </div>
    </div>
</div>
</div>
</div>
<?php endif; ?>

<?php //wp_reset_postdata(); ?>

<?php get_footer(); ?>
