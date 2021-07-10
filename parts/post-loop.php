<?php
//grab data


$prop_title      = get_the_title();
$prop_img        = get_the_post_thumbnail_url(null, 'large');
$default         = get_the_post_thumbnail($post->ID, 'medium');
$thumb           = empty($prop_img) ? $default : $prop_img;

$prop_link       = get_the_permalink();

$data            = wp_parse_args(get_post_meta($post->ID), array(
    '_prop_combustible' => 1,
    '_prop_transmision' => 1,
    '_prop_motor'       => 0,
    '_prop_año'         => 2000,
));

pr($data);
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

//$type            = get_the_terms($post, 'tipo')[0];
//$ops             = get_the_terms($post->ID, 'operacion');
//$prop_loc        = get_location($post);
//$statuses        = get_the_terms($post->ID, 'status')[0];

//var_dump($prop_sale);

?>
<div <?php post_class('card') ?> id="post-<?php the_ID(); ?>">
    <div class="card-image">
        <div class="card-image-top">
            <?php
            echo '<ul class="list-inline">';
            if($statuses):
                echo sprintf('<li><a class="tag is-info" href="%s">%s</a></li>', get_term_link($statuses), $statuses->name);
            endif;
            if($ops):
                foreach($ops as $op):
                    echo sprintf('<li><a class="tag is-primary" href="%s">%s</a></li>', get_term_link($op), $op->name);
                endforeach;
            endif;
            if($prop_feat):
                echo sprintf('<li><span class="tag is-warning">%s</span></li>', __('Destacado', 'propress'));
            endif;
            echo '</ul>';
            ?>
        </div>
        <figure class="image">
            <?php echo sprintf('<a href="%s"><img src="%s" /></a>', get_permalink(),  $thumb); ?>
        </figure>
    </div>
    <div class="card-content">
        <div class="media">
            <div class="media-content">
                <div class="">
                    <a href="<?php the_permalink() ?>">
                        <span class="prop-info">
                            <span class="title is-4">
                                <?php the_title(); ?>
                            </span>
                            <span class="subtitle is-6">
                                <?php
                                if($prop_address):
                                    echo $prop_address;
                                endif;
                                if ($prop_loc):
                                    echo sprintf('- %s', $prop_loc);
                                endif;
                                ?>
                            </span>
                        </span>
                        <?php
                        //$args = $data;
                        //pase todos los contenidos a un template
                        //get_template_part('parts/price','block', $data)
                        echo price_block($post->ID);
                        ?>
                    </a>
                </div>
            </div>
            <?php if(isset($type)): ?>
                <div class="media-right">
                    <a class="prop-icon-type" href="<?= isset($type) ? get_term_link($type) : get_bloginfo('home').'/?s='; ?>" title="<?php echo __('Tipo de propiedad') ?>">
                        <span class="material-icons md-36" <?= isset($type) ? $type->name : __('Propiedad', 'tnb'); ?>>business</span>
                        <span>
                            <?= $type->name  ?>
                        </span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-footer is-align-items-center card-footer-padding">
        <div class="is-justify-content-flex-start is-flex-grow-2">
            <div class="level">
            <ul class="level-left">
                <?php if(isset($prop_dormrooms)):
                    $dorms = intval($prop_dormrooms);
                    ?>
                    <li class="level-item">
                        <span class="icon-text">
                            <?php //$title = sprintf(ngettext("%d Dormitorio", "%d Dormitorios", $dorms), $dorms); ?>
                            <?php $title = sprintf("%d Dormitorios", $dorms); ?>
                            <span class="icon material-icons icon-small" title="<?= $title ?>">hotel</span>
                            <span><?php echo sprintf("%d", $dorms); ?></span>
                        </span>
                    </li>
                <?php endif; ?>
                <?php
                if(isset($prop_bathrooms)):
                    $baths = intval($prop_bathrooms);
                    ?>
                    <li class="level-item">
                        <span class="icon-text">
                            <?php $title = sprintf("%d Baños", $baths);?>
                            <span class="icon material-icons icon-small" title="<?= $title ?>">
                                bathtub
                            </span>
                            <span><?= sprintf("%d", $baths);?></span>
                        </span>
                    </li>
                <?php endif; ?>
            </ul>
            </div>
            <?php /*
            <ul class="list-inline">
                <?php if(isset($prop_dormrooms)):
                    $dorms = intval($prop_dormrooms);
                    ?>
                    <li class="icon-text">
                        <span class="icon material-icons icon-small" title="<?php echo sprintf(ngettext("%d Dormitorio", "%d Dormitorios", $dorms), $dorms); ?>">
                            hotel
                        </span>
                        <span><?php echo sprintf("%d", $dorms); ?></span>
                    </li>
                <?php endif; ?>
                <?php
                if(isset($prop_bathrooms)):
                    $baths = intval($prop_bathrooms);
                    ?>
                    <li class="icon-text">
                        <span class="icon material-icons icon-small" title="<?php echo sprintf(ngettext("%d Baño", "%d Baños", $baths), $baths);?>">
                            bathtub
                        </span>
                        <span><?= sprintf("%d", $baths);?></span>
                    </li>
                <?php endif; ?>
            </ul>
            */ ?>
        </div>
        <a class="button is-primary" href="<?php the_permalink() ?>">
            <?php echo __('Ver Más') ?>
        </a>
    </div>
</div>
