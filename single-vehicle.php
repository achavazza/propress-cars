<?php
get_header();

//pr(get_post_meta ($post->ID));
//$mapGPS  = get_post_meta ($post->ID, '_prop_map', true );
//$address = get_post_meta ($post->ID, '_prop_address', true);
//$extra   = get_post_meta ($post->ID, '_prop_extra', true);
//$price   = get_post_meta ($post->ID, '_prop_price', true);

//var_dump(get_post_meta($post->ID, '_prop_features'));
//pr(get_service_list());

$data              = get_post_meta($post->ID);


$prop_title        = get_the_title();
$prop_img          = get_the_post_thumbnail_url(null, 'thumbnail');
$prop_link         = get_the_permalink();

//$type              = get_the_terms($post, 'type')[0];
//$ops               = get_the_terms($post, 'operation')[0];

?>
<div class="search-panel">
	<div class="container">
		<?php echo get_search_form(); ?>
	</div>
</div>

<div class="block">
	<div class="container">
	</div>
</div>
<div class="container">
    <?php the_breadcrumb(); ?>
    <?php include('inc/featured-image.php'); ?>
	<div class="columns">
		<div class="column is-three-quarters">

			<?php if (have_posts()) :?>
			<?php /*
            <div class="column is-three-quarters">
            */ ?>
			<?php while (have_posts()) : the_post(); ?>
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<div class="card block">
					<div class="card-content">
					<div class="media">
					<div class="media-content">
						<h2 class="title is-3">
							<?php if($prop_address): ?>
								<?php echo $prop_address; ?>
								<?php echo $prop_extra ? sprintf('<span class="em"> - %s</span>', $prop_extra) : ''; ?>
							<?php else: ?>
								<?php echo get_the_title(); ?>
							<?php endif; ?>
						</h2>
						<h3 class="subtitle is-4">
							<?php //echo $prop_loc ? ' &mdash; '.$prop_loc : ''; ?>
							<?php echo sprintf('<span class="sub-title">%s</span>', $prop_loc ? $prop_loc : '') ?>
						</h3>
                        <?php
                        //$args = $data;
                        //pase todos los contenidos a un template
                        get_template_part('parts/price','block', $data) ?>
                    </span>
					</div>
                    <div class="media-right">
                        <a class="prop-icon-type" href="<?= isset($type) ? get_term_link($type) : get_bloginfo('home').'/?s='; ?>" title="<?php echo __('Tipo de propiedad') ?>">
                            <span class="material-icons md-36" <?= isset($type) ? $type->name : __('Propiedad', 'tnb'); ?>>business</span>
                            <span>
                                <?= $type->name  ?>
                            </span>
                        </a>
                    </div>
					</div>
                    <div>
                        <nav class="level">
                        <div class="level-left">
                        <?php if(!$prop_sale && !$prop_rent):
                            if($contact_form):
                                echo '<div class="level-item">';
                                echo '<a class="button is-primary modal-button" data-target="#contact_form">Informarme el precio</a>';
                                echo '</div>';
                                //echo '<a class="btn btn-primary" data-lity="" href="#contact_form" style="padding:7px">Informarme el precio</a>';
                            endif;
                        else:
                            if($notification_form):
                                echo '<div class="level-item">';
                                echo '<a class="button is-primary modal-button" data-target="#notificacion">Avisarme si baja el precio</a>';
                                //echo '<a class="btn btn-primary" data-lity="" href="#notificacion" style="padding:7px">Avisarme si baja el precio</a>';
                                echo '</div>';
                            endif;
                        endif;
                        ?>
                        </div>
                        </nav>
                    </div>
					</div>
					</div>

                    <?php
                    // caracteristicas de la propiedad
                    get_template_part('parts/props/prop','features') ?>

					<?php
                    // contenido de la page
                    // lo que se tipee aparece aqui
					$content = get_the_content();
					$content_desktop = apply_filters("the_content", $content);
					?>
					<?php if($content): ?>
                        <div class="card block">
    						<div class="card-header">
								<h3 class="card-header-title">
                                    <?php echo __('Descripción de la propiedad') ?>
                                </h3>
							</div>
							<div class="card-content">
								<div class="entry">
									<?php echo wpautop($content_desktop); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

                    <?php
                    // detalles
                    // descripcion de servicios y detalles de la propieadd
                    //get_template_part('parts/props/prop','details')
                    get_template_part('parts/props/prop','interior') 
                    ?>

				</div>
			</div>
		<?php endwhile;?>
	<?php endif; ?>
		<div class="column is-one-quarter sticky-container">
            <?php //include (TEMPLATEPATH . '/inc/agents.php' ); ?>
			<?php get_sidebar('propiedad'); ?>
		</div>
	</div>
</div>
<div class="section">
    <div class="container">
        <?php //include (TEMPLATEPATH . '/inc/related.php' ); ?>
    </div>
</div>
<?php
	//wp_enqueue_script('lity');
	include('inc/photoswipe-gallery.php');
	get_footer();
?>
