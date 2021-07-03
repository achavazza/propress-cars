<?php get_header(); ?>
<div class="container mt-5">
	<?php the_breadcrumb(); ?>
	<div class="columns">
		<div class="column is-three-quarters">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
					<div class="mb-2">
						<?php echo get_the_post_thumbnail($post->ID, 'large', array( 'class' => 'img-fluid')); ?>
					</div>
					<h2 class="h2"><?php the_title(); ?></h2>
					<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
					<div class="entry">
						<?php the_content(); ?>
					</div>
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
