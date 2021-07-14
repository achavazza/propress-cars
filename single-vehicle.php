<?php
get_header();

$prop_title      = get_the_title();
$prop_img        = get_the_post_thumbnail_url(null, 'large');
$default         = get_the_post_thumbnail($post->ID, 'medium');
$thumb           = empty($prop_img) ? $default : $prop_img;

$prop_link       = get_the_permalink();

$data            = wp_parse_args(get_post_meta($post->ID), array(
    '_prop_combustible' => 1,
    '_prop_transmision' => 1,
    //'_prop_brand'       => 'Marca',
    '_prop_motor'       => 0,
    '_prop_año'         => 2000,
    '_prop_puertas'     => 2,
));

//pr($data);
//pr($data['_prop_motor'][0]);

//$prop_address    = $data['_prop_address'][0];
//$prop_extra      = $data['_prop_extra'][0];
//$prop_feat       = $data['_prop_featured'][0];
//$mapGPS          = get_post_meta($post->ID, '_prop_map', true);

//$prop_rooms      = $data['_prop_rooms'][0];
//$prop_sup        = $data['_prop_sup'][0];
//$prop_dormrooms  = $data['_prop_dormrooms'][0];
//$prop_bathrooms  = $data['_prop_bathrooms'][0];
//$prop_garage     = $data['_prop_garage'][0];
//$prop_time       = $data['_prop_time'][0];


//ahora estan parts/price-block.php
//$prop_sale         = ($data['_prop_price_sale'][0]!= 0) ? number_format($data['_prop_price_sale'][0], 0, ',', '.') : '';
//$prop_rent         = ($data['_prop_price_rent'][0]!= 0) ? number_format($data['_prop_price_rent'][0], 0, ',', '.') : '';
//$prop_currency     = currency()[$data['_prop_currency'][0]];
//$cur_symbol      = $prop_currency ? '$' : 'U$S';

$brand             = get_the_terms($post->ID, 'brand')[0];
$cond              = get_the_terms($post->ID, 'condition')[0];
$tran              = transmision()[$data['_prop_transmision'][0]];
$comb              = combustible()[$data['_prop_combustible'][0]];

$motor             = $data['_prop_motor'][0];
$format            = get_the_terms($post->ID, 'format')[0];
$puertas           = $data['_prop_puertas'];

//$ops             = get_the_terms($post->ID, 'operacion');
//$prop_loc        = get_location($post);
//$statuses        = get_the_terms($post->ID, 'status')[0];

//var_dump($prop_sale);
//pr($brand);
//pr($cond);
//pr($tran);

$notification_form = get_option('tnb_extra_options')['tnb_options_notification_form'];
?>
<?php include('inc/slider.php'); ?>
<div class="container">
    <div class="search-panel">
		<?php echo get_search_form(); ?>
    </div>
</div>

<div class="container">
    <?php the_breadcrumb(); ?>
</div>
<div class="container">
    <div class="columns">
        <div class="column is-three-quarters">
            <h2 class="title is-2">
                <?php echo get_the_title(); ?>
            </h2>
        </div>
        <div class="column is-one-quarter">
            <?php
            //$args = $data;
            //pase todos los contenidos a un template
            //get_template_part('parts/price','block', $data)
            echo price_block($post->ID);
            ?>
        </div>
    </div>
</div>

<div class="featured">
    <div class="container">
        <?php include('inc/featured-image.php'); ?>
    </div>
</div>
<div class="container">
	<div class="columns">
		<div class="column is-three-quarters">

			<?php if (have_posts()) :?>
			<?php /*
            <div class="column is-three-quarters">
            */ ?>
			<?php while (have_posts()) : the_post(); ?>
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">


                    <?php
                    // caracteristicas de la propiedad
                    get_template_part('parts/props/prop','features')  ?>

                    <div class="card block">
                        <div class="card-header">

                            <h3 class="card-header-title">
                                <?php echo __('Descripción') ?>
                            </h3>
                        </div>
    					<?php
                        // contenido de la page
                        // lo que se tipee aparece aqui
    					$content = get_the_content();
    					$content_desktop = apply_filters("the_content", $content);
    					?>
    					<?php if($content): ?>
    							<div class="card-content">
    								<div class="entry">
    									<?php echo wpautop($content_desktop); ?>
    								</div>
    							</div>
    					<?php endif; ?>
                    </div>

                    <?php
                    // detalles
                    // descripcion de servicios y detalles de la propieadd
                    //get_template_part('parts/props/prop','details')
                    get_template_part('parts/props/prop','interior')
                    ?>
                    <?php
                    // detalles
                    // descripcion de servicios y detalles de la propieadd
                    get_template_part('parts/props/prop','additionals')
                    ?>

				</div>
			</div>
		<?php endwhile;?>
	<?php endif; ?>
		<div class="column is-one-quarter sticky-container">
            <?php //pr($data) ?>
            <table class="table is-fullwidth">
                <tr>
                    <th><?php echo __('Tamaño motor', 'tnb') ?></th>
                    <td><?php printf('%s <span>cm<sup>3</sup></span>', $motor); ?></td>
                </tr>
                <tr>
                    <th><?php echo __('Carrocería', 'tnb') ?></th>
                    <td><?php printf('%s', $format->name); ?></td>
                </tr>
                <tr>
                    <th><?php echo __('Puertas', 'tnb') ?></th>
                    <td><?php printf('%s', $puertas); ?></td>
                </tr>
            </table>

            <?php
            if($notification_form):
                echo '<a class="button is-fullwidth is-primary modal-button" data-target="#notificacion">Solicitar información</a>';
                //echo '<a class="btn btn-primary" data-lity="" href="#notificacion" style="padding:7px">Avisarme si baja el precio</a>';
            endif;
            ?>
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


<?php if($notification_form): ?>
    <div id="notificacion" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    <?php echo __('Solicitar mas información', 'tnb') ?>
                    <?php the_title(); ?>
                </p>
              <button class="delete" aria-label="close"></button>
          </header>
          <section class="modal-card-body">
              <?php echo do_shortcode($notification_form, true); ?>
          </section>
        </div>
    </div>
<?php endif; ?>
<?php
	//wp_enqueue_script('lity');
	include('inc/photoswipe-gallery.php');
	get_footer();
?>
