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
    //'_prop_brand'       => 'Marca',
    '_prop_motor'       => 0,
    '_prop_año'         => 2000,
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
$trans             = transmision()[$data['_prop_transmision'][0]];
$comb              = combustible()[$data['_prop_combustible'][0]];
//$ops             = get_the_terms($post->ID, 'operacion');
//$prop_loc        = get_location($post);
//$statuses        = get_the_terms($post->ID, 'status')[0];

//var_dump($prop_sale);
//pr($brand);
//pr($cond);
//pr($tran);

?>
<div <?php post_class('card') ?> id="post-<?php the_ID(); ?>">
    <div class="card-image">
        <?php /*
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
        */ ?>
        <figure class="image">
            <?php echo sprintf('<a href="%s"><img src="%s" /></a>', get_permalink(),  $thumb); ?>
        </figure>
    </div>
    <div class="card-content">
        <div class="">
            <a href="<?php the_permalink() ?>">
                <span class="has-text-centered">
                    <span class="title is-normal is-5 mb-0">
                        <?= $brand->name; ?>
                    </span>
                    <span class="title is-primary is-bold is-2 mb-5">
                        <?php echo get_the_title($post); ?>
                    </span>
                </span>
                <span class="level has-text-grey is-mobile">
                    <?= $cond ? sprintf('<span class="level-item is-flex-direction-column"><i class="icon-modelo"></i> %s</span>', $cond->name) : ''; ?>
                    <?= $trans ? sprintf('<span class="level-item is-flex-direction-column"><i class="icon-trans-alt"></i> %s</span>', $trans) : ''; ?>
                    <?= $comb ? sprintf('<span class="level-item is-flex-direction-column"><i class="icon-comb"></i> %s</span>', $comb) : ''; ?>
                    <?php /*
                    <span class="level-item is-flex-direction-column">
                        <i class="icon"></i>
                        <span><?= $cond->name  ?></span>
                    </span>
                    <span class="level-item is-flex-direction-column">
                        <i class="icon"></i>
                        <?= $tran ?>
                    </span>
                    <span class="level-item is-flex-direction-column">
                        <i class="icon"></i>
                        <?= $comb ?>
                    </span>
                    */ ?>
                </span>
            </a>
        </div>
    </div>
    <div class="card-footer card-footer-padding is-flex-direction-column">
        <div class="">
            <?php
            //$args = $data;
            //pase todos los contenidos a un template
            //get_template_part('parts/price','block', $data)
            echo price_block($post->ID);
            ?>
        </div>
        <div>
            <a class="button is-primary is-fullwidth" href="<?php the_permalink() ?>">
                <?php echo __('Más información', 'tnb') ?>
            </a>
        </div>
    </div>
</div>
