<?php //pr(get_post_meta( get_the_ID(), 'extra_metabox', true )); ?>

<?php
$slider_id = get_post_meta( get_the_ID(), 'extra_slider', true  );
$args = array(
    'post_type' => 'slide',
    'tax_query' => array(
        array(
            'taxonomy' => 'slider',
            'field' => 'term_id',
            'terms' => $slider_id
        )
    )
);
$slider_query = new WP_Query( $args );
if( $slider_query->have_posts() ):
    $slider_props = get_term_meta($slider_id);
    if(empty((int)$slider_props['slider_term_w'][0])){
        $slider_props['slider_term_w'][0] = 1200;
        //$slider_props['slider_term_w'][0] = 1200;
    }
    if(empty((int)$slider_props['slider_term_h'][0])){
        $slider_props['slider_term_h'][0] = 400;
        //$slider_props['slider_term_h'][0] = 675;
    }

    $calc    = round(((int)$slider_props['slider_term_h'][0] * 100) / (int)$slider_props['slider_term_w'][0], 2);

    if($slider_props['slider_term_h'][0]){
        $height = 'height:'.$slider_props['slider_term_h'][0].'px;';
    }
    //$padding = 'padding-bottom:'.$calc.'';

    //pr($slider_props);
    // Slider main container
    echo '<div class="swiper-main-container" style="'.$height.'">';
        // Additional required wrapper
        echo '<div class="swiper-wrapper">';
            // Slides
            while( $slider_query->have_posts() ) : $slider_query->the_post();
                $content_align = (get_post_meta($post->ID)['slide_prop_align']) ? get_post_meta($post->ID)['slide_prop_align'][0] : '';
                $bg      = get_the_post_thumbnail_url(get_the_ID(),'full');
                $props   = 'background-image:url('.$bg.');';
                $content = sprintf('<div class="container"><div class="content %s">%s</div></div>', $content_align, get_the_content(get_the_ID()));

                echo sprintf('<div class="swiper-slide" style="%s">%s</div>', $props, $content);
            endwhile;
        echo '</div>';
        // If we need pagination
        echo '<div class="swiper-pagination"></div>';

        // If we need navigation buttons
        echo '<div class="swiper-button-prev"></div>';
        echo '<div class="swiper-button-next"></div>';

        // If we need scrollbar
        //echo '<div class="swiper-scrollbar"></div>';
    echo '</div>';
    //$atts  = 'width:'.$slider_props['slider_term_w'][0].'px;';
    //$atts .= 'height:'.$slider_props['slider_term_h'][0].'px;';
    //echo '</div>';
    //pr($slider_query);
    //pr($slider_props);
    /*
    echo '<script>var animated = false</script>';
    if($slider_props['slider_term_animated'][0]){
        echo '<script>var animated = true</script>';
    };
    echo '<script>var loop = false;</script>';
    if($slider_props['slider_term_loop'][0]){
        echo '<script>var loop = true</script>';
    };
    echo '<script>var time = -1;</script>';
    if($slider_props['slider_term_time'][0]){
        echo '<script>var time = '.intval($slider_props['slider_term_time'][0]).'</script>';
    };
    wp_enqueue_script('siema-init', true);
    echo '</div>';
    */
?>
<?php
wp_enqueue_script('swiperjs-init', true);

else:
    $url = get_attachment_url_by_slug('default', 'full');
    $height = '';
    $bpos = '';
    //$bg = 'background: url('.get_attachment_url_by_slug('default', 'full').')';
    //pr(get_the_post_thumbnail($post->ID));
    if(get_the_post_thumbnail_url($post->ID) && is_page()){
        $url = get_the_post_thumbnail_url($post->ID, 'full');
        $height = 'height:500px;max-width:100%;';
        $bpos = 'background-position: center center;background-size:cover;';
    }
    $bg = sprintf('background: url(%s);', $url);
    echo sprintf('<div id="main-thumbnail" style="%s %s %s">',$bg,$height,$bpos);
    echo '<div class="container">';
    //echo get_the_post_thumbnail(get_the_ID(),'large');
    echo '</div>';
    echo '</div>';
endif;

//wp_enqueue_script('slider');
?>
<?php wp_reset_postdata(); ?>
<?php //pr(get_post_meta( get_the_ID(), 'extra_image_position', true )); ?>
<?php //pr(get_post_meta( get_the_ID())); ?>
<?php //pr(get_the_id()); ?>
