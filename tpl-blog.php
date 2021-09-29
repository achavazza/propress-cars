<?php
/*
Template Name: Blog
Template Post Type: page
*/
get_header(); ?>
<?php include('inc/slider.php'); ?>
<div class="container">
	<?php //the_breadcrumb(); ?>
	<h2 class="h2 title"><?php the_title(); ?></h2>
	<div class="columns is-multiline">
		<div class="column-three-quarters">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part('parts/post','loop') ?>
				<?php endwhile; ?>
			<?php else : ?>
				<div class="card">
					<h2 class="card-content">:( No encontramos vehículos</h2>
					<p>
						Por favor, vuelva al inicio
						<hr />
						<a class="btn btn-primary" href="<?php echo get_bloginfo('home') ?>">< Volver al Inicio</a>
					</p>
				</div>
			<?php endif; ?>
			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

		</div>
		<div class="column-one-quarter">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
