<?php
/*
Template Name: Contacto
Template Post Type: page
*/
//pr($options);
$options  = get_option('tnb_main_options');
$address  = $options['tnb_options_address'];
$location  = $options['tnb_options_location'];
$phones    = $options['tnb_options_phone'];
$facebook = $options['tnb_options_facebook'];
$twitter  = $options['tnb_options_twitter'];
$instagram  = $options['tnb_options_instagram'];
$whatsapp  = $options['tnb_options_whatsapp'];
$email    = $options['tnb_options_email'];
//$mapGPS   = $options['_site_map'];
$map_embed   = $options['textarea_map'];

/*
$mapsSearch = '';
if($options['tnb_options_map']){
    $mapGPS    = isset($options['tnb_options_map']) ? $options['tnb_options_map'] : '';
    $mapsSearch = sprintf('https://www.google.com.ar/maps/place/%s/@%s,%s,14z', str_replace(' ','+',$mapGPS['address']),$mapGPS['latitude'], $mapGPS['longitude']);
}
*/

$extra    = get_option('tnb_extra_options');

$cf7      = isset($extra['tnb_options_contact_form']) ? $extra['tnb_options_contact_form'] : '';

get_header(); ?>
<?php include('inc/slider.php'); ?>
<div class="container">
    <?php // the_breadcrumb(); ?>
    <div class="block-title mb-4">
        <h3 class="title is-4">
            <?php the_title(); ?>
        </h3>
    </div>
	<div class="columns">
		<div class="column is-one-half">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post mb-6" id="post-<?php the_ID(); ?>">
					<?php //include (TEMPLATEPATH . '/inc/meta.php' ); ?>
                    <div class="entry">
        				<?php the_content(); ?>
        			</div>
        			<?php //wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
        			<?php //edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
        			<div class="card">
            			<div class="card-content">
                            <?php
                            if(isset($cf7 )){
                                echo do_shortcode($cf7);
                            }else{
                                include ('inc/admin/contact-form.php' );
                            }
                            ?>
            			</div>
        			</div>
					<?php //edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
				</div>
				<?php //comments_template(); ?>
			<?php endwhile; endif; ?>
			<?php include('inc/gallery.php'); ?>
		</div>
		<div class="column is-one-half">
            <?php


    		if(isset($options) && !empty($options)):
    			echo '<div class="card">';
                /*
                echo '<div class="card-header">';
                    echo '<h3 class="card-header-title">Datos de contacto</h3>';
                echo '</div>';
                */

    			echo '<div class="card-content">';
    			echo '<dl class="dl-list">';
    			if(isset($address) && !empty($address)):
    				echo '<dt>Dirección</dt>';
    				echo '<dd>'.$address.'</dd>';
    			endif;
    			if(isset($location) && !empty($location)):
    				echo '<dt>Localidad</dt>';
    				echo '<dd>'.$location.'</dd>';
    			endif;
    			if(isset($phones) && !empty($phones)):
    				echo '<dt>Teléfono</dt>';
                    foreach($phones as $phone){
			            echo sprintf('<dd><a href="tel:%s">%s</a></dd>', $phone, $phone);
                    }
    			endif;
    			if(isset($email) && !empty($email)):
    				echo '<dt>Email</dt>';
    				echo sprintf('<dd><a href="mailto:%s">%s</a></dd>', $email, $email);
    			endif;
    			echo '</dl>';
    			echo '<br/ >';
                ?>
                <div class="level is-mobile">
                <div class="level-left">
                    <?= $whatsapp ? sprintf('<a href="%s" title="Contactanos via WhatsApp" class="level-item"><i class="fab fa-whatsapp"></i></a>', $whatsapp) : ''; ?>
                    <?= $twitter ? sprintf('<a href="%s" title="Visítanos en Twitter" class="level-item"><i class="fab fa-twitter"></i></a>', $twitter) : ''; ?>
                    <?= $facebook ? sprintf('<a href="%s" title="Visítanos en Facebook" class="level-item"><i class="fab fa-facebook-f"></i></a>', $facebook) : ''; ?>
                    <?= $instagram ? sprintf('<a href="%s" title="Visítanos en Instagram" class="level-item"><i class="fab fa-instagram"></i></a>', $instagram) : ''; ?>
                </div>
                </div>
                <?php
    			echo '<br/ >';

                if(isset($map_embed)):
                echo '<div class="map-embed">';
                    echo $map_embed;
                echo '</div>';
                endif;
                /*
    			if(isset($mapGPS) && !empty($mapGPS)){
    				renderMap($mapGPS['latitude'],$mapGPS['longitude']);
    			}
                */

    			echo '</div>';
    			echo '</div>';
    		endif;
    		//$mapGPS  = get_post_meta ($post->ID, '_prop_map', true );
    		?>
    		<?php //get_sidebar(); ?>
		</div>
	</div>
</div>
<?php include('inc/photoswipe-gallery.php'); ?>
<?php get_footer(); ?>
