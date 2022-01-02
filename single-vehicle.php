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
$model             = isset($data['_prop_model']) ? $data['_prop_model'] : '';
$year              = isset($data['_prop_year']) ? $data['_prop_year'] : '';

$cond              = get_the_terms($post->ID, 'condition')[0];


$motor             = $data['_prop_motor'];
$km                = isset($data['_prop_km']) ? $data['_prop_km'] : '';

$type              = get_the_terms($post->ID, 'type')[0];
//$format            = get_the_terms($post->ID, 'type')[0];
$puertas           = $data['_prop_puertas'];
//$trans             = get_the_terms($post->ID, 'transmision');
//$comb              = get_the_terms($post->ID, 'combustible');
$trans             = transmision()[$data['_prop_transmision'][0]];
$comb              = combustible()[$data['_prop_combustible'][0]];


$color             = isset( $data['_prop_color'][0] ) ? $data['_prop_color'][0] : '';
$tapizado          = isset( $data['_prop_tapizado'][0] ) ? $data['_prop_tapizado'][0] : '';
$direccion         = isset( $data['_prop_direccion'][0] ) ? $data['_prop_direccion'][0] : '';
$traccion          = isset( $data['_prop_traccion'][0] ) ? $data['_prop_traccion'][0] : '';
$placa             = isset( $data['_prop_placa'][0] ) ? $data['_prop_placa'][0] : '';
$calefaccion       = isset( $data['_prop_calefaccion'][0] ) ? yesno()[$data['_prop_calefaccion'][0]] : '';
$aire              = isset( $data['_prop_aire'][0] ) ? yesno()[$data['_prop_aire'][0]] : '';
$vidrios           = isset( $data['_prop_vidrios'][0] ) ? $data['_prop_vidrios'][0] : '';
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
<?php /*
<div class="container">
    <div class="search-panel">
		<?php echo get_search_form(); ?>
    </div>
</div>
*/ ?>
<?php /*
<div class="container">
    <?php the_breadcrumb(); ?>
</div>
*/ ?>

<div class="is-light-gray">
<div class="container">
	<div class="columns is-multiline">
		<div class="column is-12 is-9-desktop">
            <div class="section">
            <div class="columns is-vcentered">
                <div class="column is-8-desktop">
                    <h2 class="title is-primary is-1 is-bold is-color-secondary mb-0">
                        <?php
                        /*
                        if ($brand && $model){
                            $title = sprintf('%s %s', $brand ? $brand->name : '', $model ? $model[0] : '');
                        }else{
                            $title = get_the_title();
                        }
                        */
                        $title = get_the_title();
                        echo $title;
                        ?>
                    </h2>
                    <span class="info is-uppercase">
                        <?= $year ? $year[0] : ''; ?>
                        <?= $cond ? sprintf('| %s', $cond->name) : ''; ?>
                        <?= $km   ? sprintf('| %s km', $km[0])   : ''; ?>
                    </span>
                </div>
                <div class="column is-4-desktop">
                    <?php
                    //$args = $data;
                    //pase todos los contenidos a un template
                    //get_template_part('parts/price','block', $data)
                    //echo price_block($post->ID);
                    $price_sale = get_post_meta( $post->ID, '_prop_price_sale')[0];
                    if(!$price_sale):
                        echo '<span class="has-text-right-tablet">';
                        printf('<span class="title is-2 is-normal">%s</span>', __('Consultar'));
                        echo '</span>';
                    else:
                        echo '<span class="has-text-right-tablet">';
                        printf('<span class="title is-2 is-normal" title="Precio de venta"><small>Precio: </small>$%s</span>', number_format($price_sale, 0, ',', '.'));
                        echo '</span>';
                    endif;
                    ?>
                    <?php echo function_exists('sharethis_inline_buttons') ?  sharethis_inline_buttons(): ''; ?>
                </div>
            </div>

            <?php include('inc/featured-image.php'); ?>
            </div>
        </div>
		<div class="column is-12 is-3-desktop sticky-container">
			<?php get_sidebar('vehicle-contact'); ?>
		</div>
	</div>
</div>
</div>
<div class="container">
	<div class="columns is-multiline">
		<div class="column is-12 is-9-desktop">
            <div class="section">

                <?php if (have_posts()) :?>
                <?php while (have_posts()) : the_post(); ?>
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        <?php
                        // caracteristicas de la propiedad
                        //get_template_part('parts/props/prop','features')  ?>

                        <div class="block">
                            <div class="block-title">
                                <h3 class="title is-4">
                                    <?php echo __('Descripción') ?>
                                </h3>
                            </div>
                            <?php
                            // contenido de la page
                            // lo que se tipee aparece aqui
                            $content = get_the_content();
                            $content_desktop = apply_filters("the_content", $content);


                            ?>
                            <div class="block-content">
                                <div class="entry">
                                    <?php if($content): ?>
                                    <?php echo wpautop($content_desktop); ?>
                                    <br />
                                    <?php endif; ?>
                                </div>
                                <ul class="list-unstyled list-2-cols caract">
                                    <?= $cond ? sprintf('<li><i class="icon-modelo"></i> <b>Estado:</b> %s</li>', $cond->name) : ''; ?>
                                    <?php /*
                                    <?= $cond ? sprintf('<li><i class="icon-estado"></i> %s</li>', $cond->name) : ''; ?>
                                    */ ?>
                                    <?= $brand ? sprintf('<li><i class="icon-modelo"></i> <b>Marca:</b> %s</li>', $brand->name) : ''; ?>
                                    <?= $model ? sprintf('<li><i class="icon-modelo"></i> <b>Modelo:</b> %s</li>', $model[0]) : ''; ?>
                                    <?= $year ? sprintf('<li><i class="icon-ano"></i> <b>Año:</b> %s</li>', $year[0]) : ''; ?>
                                    <?= $km ? sprintf('<li><i class="icon-km"></i> <b>Kilometraje:</b> %s Kms</li>', $km[0]) : ''; ?>
                                    <?= $motor ? sprintf('<li><i class="icon-motor"></i> <b>Motor:</b> %s cm<sup>3</sup></li>', $motor[0]) : ''; ?>
                                    <?php /*
                                    <?= $trans ? sprintf('<li><i class="icon-trans"></i> %s</li>', $trans) : ''; ?>
                                    */ ?>
                                    <?= $trans ? sprintf('<li><i class="icon-trans-alt"></i> <b>Transmisión:</b> %s</li>', $trans) : ''; ?>
                                    <?= $comb ? sprintf('<li><i class="icon-comb"></i> <b>Combustible:</b> %s</li>', $comb) : ''; ?>
                                    <?= $color ? sprintf('<li><i class="icon-color"></i> <b>Color:</b> %s</li>', $color) : ''; ?>
                                    <?= $tapizado ? sprintf('<li><i class="icon-tapizado"></i> <b>Tapizado:</b> %s</li>', $tapizado) : ''; ?>
                                    <?= $direccion ? sprintf('<li><i class="icon-direccion"></i> <b>Dirección:</b> %s</li>', $direccion) : ''; ?>
                                    <?= $traccion ? sprintf('<li><i class="icon-traccion"></i> <b>Tracción:</b> %s</li>', $traccion) : ''; ?>
                                    <?= $type ? sprintf('<li><i class="icon-tipo"></i> <b>Tipo:</b> %s</li>', $type->name) : ''; ?>
                                    <?= $placa ? sprintf('<li><i class="icon-placa"></i> <b>Placa:</b> %s</li>', $placa) : ''; ?>
                                    <?= $aire ? sprintf('<li><i class="icon-aire"></i> <b>Aire Acondicionado:</b> %s</li>', $aire) : ''; ?>
                                    <?= $calefaccion ? sprintf('<li><i class="icon-calefaccion"></i> <b>Calefacción:</b> %s</li>', $calefaccion) : ''; ?>
                                    <?= $vidrios ? sprintf('<li><i class="icon-vidrios"></i> <b>Vidrios:</b> %s</li>', $vidrios) : ''; ?>
                                </ul>
                                <?php // pr($data) ?>
                            </div>
                        </div>

                        <?php
                        // detalles
                        // descripcion de servicios y detalles de la propieadd
                        //get_template_part('parts/props/prop','details')
                        get_template_part('parts/props/prop','additionals')
                        ?>


                        <?php
                        // imperfecciones
                        get_template_part('parts/props/prop','gallery-alt');
                        include('inc/photoswipe-gallery-alt.php');
                        ?>


                        <?php
                        // detalles
                        // descripcion de servicios y detalles de la propieadd
                        get_template_part('parts/props/prop','finance')
                        ?>

                        <?php if ( is_active_sidebar( 'vehicle-foot-widgets' ) ) : ?>
                                <?php dynamic_sidebar( 'vehicle-foot-widgets' ); ?>
                        <?php endif; ?>
                        <?php // if (function_exists('dynamic_sidebar') && dynamic_sidebar('Pie de vehiculo')) : else : endif; ?>

                    </div>
                <?php endwhile;?>
                <?php endif; ?>

            </div>
        </div>
		<div class="column is-12 is-3-desktop sticky-container">
			<?php get_sidebar('vehicle'); ?>
		</div>
	</div>
</div>
<div class="container">
	<div class="columns">
		<div class="column is-12 is-9-desktop">
		<div class="section-mobile">
            <?php include (TEMPLATEPATH . '/inc/related.php' ); ?>
        </div>
        </div>
        <div class="column is-12 is-3-desktop"></div>
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
