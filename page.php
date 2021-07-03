<?php get_header(); ?>
<?php include('inc/slider.php'); ?>
<div class="container">
    <?php the_breadcrumb(); ?>
	<div class="columns">
		<div class="column is-three-quarters">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<h2 class="title is-3"><?php the_title(); ?></h2>
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
		<div class="column is-one-quarter">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php
include('inc/photoswipe-gallery.php');
?>
<?php get_footer(); ?>
