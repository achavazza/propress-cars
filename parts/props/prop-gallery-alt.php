<?php $gallery_images_desc = get_post_meta( get_the_ID(), '_prop_images_alt_details', 1); ?>
<?php $gallery_images_alt = get_post_meta( get_the_ID(), '_prop_images_alt', 1); ?>
<?php if($gallery_images_desc || $gallery_images_alt): ?>
<div class="block">
    <div class="block-title">
        <h3 class="title is-4">
            <?php echo __('Imperfecciones', 'tnb'); ?>
        </h3>
    </div>
    <div class="block-content">
        <?php echo wpautop($gallery_images_desc); ?>
        <br />
        <div id="gallery-alt" class="block">
        <?php
        if ( ! empty( $gallery_images_alt ) ) :
            $count = count($gallery_images_alt);
            echo '<span class="img-list">';
                foreach ( $gallery_images_alt as $gallery_image ) :
                    //pr($gallery_image);
                    //die();
                    $image = wp_get_attachment_image_src( attachment_url_to_postid($gallery_image), 'large');
                    $thumb = wp_get_attachment_image(attachment_url_to_postid( $gallery_image), 'thumbnail' );
                    //$thumb = wp_get_attachment_image( $gallery_image, 'thumbnail' );
                    //$img   = wp_get_attachment_image_src( $gallery_image[0], 'thumbnail');
                    //$thumb = '<img src="'.$img[0].'" width="'.$img[1].'" height="'.$img[2].'" />';
                    if($postThumbnailID == $gallery_image){
                        continue;
                    }
                    /*
                    $style = '';
                    if($i > $limit){
                        $block  = '<figure class="img-limit">';
                        $block .= '<a class="thumb limit" data-index="'.$i.'" href="'.$image[0].'" itemprop="contentUrl" data-size="'.$image[1].'x'.$image[2].'">';
                        $block .= $thumb;
                        //$block .= wp_get_attachment_image( $gallery_image, 'thumbnail' );
                        $block .= '<span>'.($count - $limit).' más ...'.'</span>';
                        $block .= '</a>';
                        $block .= '</figure>';

                        $style  = 'style="display:none"';
                    }
                    */

                    $figure = '<figure '.$style.' >';
                        $figure .= '<a class="thumb" data-index="'. $i .'" href="'. $image[0] .'" itemprop="contentUrl" data-size="'. $image[1].'x'.$image[2] .'">';
                            $figure .= $thumb;
                        $figure .= '</a>';
                    $figure .= '</figure>';

                    echo $figure;

                    $i++;
                endforeach;
                echo $block;

            echo '</span>';
        endif;


        ?>
        </div>
    </div>
</div>
<?php endif; ?>
