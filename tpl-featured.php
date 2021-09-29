<?php
/*
Template Name: Destacados
Template Post Type: page
*/
get_header(); ?>
<?php include('inc/slider.php'); ?>
<div class="container">
    <div class="search-panel">
		<?php echo get_search_form(); ?>
    </div>
</div>
<div class="container">
<?php the_breadcrumb(); ?>
	<?php
		$args = array(
			'post_type'           => 'vehicle',
			//'category_name'       => 'current',
			//'ignore_sticky_posts' => 1,
			//'paged'               => $paged
			'meta_query'  => array(
		            array(
		                'key'     => '_prop_featured',
		                //'value'   => true,
						'compare' => '=',
		            )
		        )
		);
		$loop = new WP_Query( $args );
	?>
	<div class="columns">
		<div class="column is-three-quarters">
			<?php if ( $loop->have_posts() ) : ?>
				<div class="columns is-same-height is-multiline">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <div class="column is-6">
                            <?php get_template_part('parts/post','loop') ?>
                        </div>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
                <?php include (TEMPLATEPATH . '/inc/notfound.php' ); ?>
			<?php endif; ?>
			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<div class="triad-1">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
