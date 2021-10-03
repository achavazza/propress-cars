<?php
/*
Template Name: Home - Solo vehículos
*/
get_header();
?>
<?php
$home  = get_option('page_on_front');
//$img   = get_the_post_thumbnail_url($home, 'slide');
$data  = get_post_meta($home);
/*
$title = $data['_home_title'][0];
$subt  = $data['_home_subtitle'][0];

if($img){
	$bg = ' style="background:url('.$img.')" ';
}*/
?>

<?php include('inc/slider.php'); ?>
<div class="container">
    <div class="search-panel">
		<?php echo get_search_form(); ?>
    </div>
</div>
<?php /*
<?php if (have_posts()) : ?>
<div class="section">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
    		<div class="post" id="post-<?php the_ID(); ?>">
    			<div class="entry">
    				<?php the_content(); ?>
    			</div>
    		</div>
        <?php endwhile;?>
    </div>
</div>
<?php endif; ?>

<?php
$args = array(
	'post_type'      => 'post',
	'posts_per_page' => 6,
	//'category_name'       => 'current',
	//'ignore_sticky_posts' => 1,
	//'paged'               => $paged
	//'post__not_in'        => $featPosts
);
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) :
	//$i = 0
    ?>
    <div class="section">
        <div class="container">
        <h3 class="title is-3"><?php echo _e('Noticias','tnb') ?></h3>

		<div class="columns is-same-height is-multiline">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<div class="column is-4">
				<?php get_template_part('parts/blog','loop') ?>
			</div>
			<?php //$i++; ?>
			<?php //echo ($i % 3 == 0) ? '</div><div class="columns">':'' ?>
		<?php endwhile; ?>
		</div>
        <div class="columns is-mobile is-centered">
            <div class="column is-4">
                <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) )  ?>" class="button is-primary is-medium is-fullwidth">
                    <?php echo _e('Ver Todas las noticias') ?>
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php //if (get_option( 'page_for_posts' )): ?>
<?php //endif; ?>
*/ ?>

<?php
$args = array(
'post_type'      => 'vehicle',
'posts_per_page' => 3,
'meta_query'  => array(
        array(
            'key'     => '_prop_featured',
            //'value'   => true,
			'compare' => '=',
        )
    )
);
$loop = new WP_Query( $args );
$featPosts =  Array();
if ( $loop->have_posts() ) : ?>
	<?php //$i = 0 ?>
    <div class="section">
        <div class="container">

        <h3 class="title is-normal is-secondary is-3"><?php echo _e('Unidades destacadas','tnb') ?></h3>
        <div class="columns is-same-height is-multiline">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <?php array_push($featPosts, get_the_ID()); ?>
			<div class="column is-4">
				<?php get_template_part('parts/post','loop') ?>
			</div>

			<?php
			//$i++;
			//echo ($i % 3 == 0) ? '</div><div class="columns">' : ''; ?>
		<?php endwhile; ?>
		</div>

        <div class="columns is-mobile is-centered">
    		<div class="column is-4">
    				<a href="<?php echo getTplPageURL('tpl-featured.php') ?>" class="button is-primary is-fullwidth">
    					<?php echo _e('Ver más unidades destacadas') ?>
    				</a>
    		</div>
    	</div>
    </div>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php
$args = array(
	//'ignore_sticky_posts' => 1,
	//'paged'               => $paged
	'post_type'      => 'vehicle',
	'posts_per_page' => 12,
	'post__not_in'   => $featPosts
);
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) :
	//$i = 0
    ?>
    <div class="section">
        <div class="container">
        <h3 class="title is-normal is-secondary is-3"><?php echo _e('Últimas unidades incorporadas','tnb') ?></h3>

    	<div class="columns is-same-height is-multiline">
    		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    			<div class="column is-4">
    				<?php get_template_part('parts/post','loop') ?>
    			</div>

    			<?php
    			//$i++;
    			//echo ($i % 3 == 0) ? '</div><div class="columns">' : '';
                ?>
    		<?php endwhile; ?>
       </div>

        <div class="columns is-mobile is-centered">
            <div class="column is-4">
                <a href="<?php echo get_bloginfo('home').'/?s=' ?>" class="button is-primary is-fullwidth">
                    <?php echo _e('Ver todas las unidades') ?>
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php //include (TEMPLATEPATH . '/inc/nav.php' ); ?>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
