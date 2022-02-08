<?php
/*
Template Name: No sidebar
Template Post Type: post, page, propiedad
*/
get_header(); ?>
<?php include('inc/slider.php'); ?>
<div class="container">
    <div class="search-panel">
		<?php echo get_search_form(); ?>
    </div>
</div>
<div class="section">
<div class="container">
    <?php // the_breadcrumb(); ?>
	<div class="columns">
		<div class="column is-full">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post mb-6" id="post-<?php the_ID(); ?>">
                    <div class="block-title mb-4">
                        <h3 class="title is-4">
                            <?php the_title(); ?>
                        </h3>
                    </div>
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
	</div>
</div>
</div>
<?php
include('inc/photoswipe-gallery.php');
?>
<?php get_footer(); ?>
