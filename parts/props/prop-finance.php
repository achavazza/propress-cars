<?php
$elems = isset(get_option('tnb_features_options')['finance']) ? get_option('tnb_features_options')['finance'] : '';
$legal = isset(get_option('tnb_features_options')['legal']) ? get_option('tnb_features_options')['legal'] : '';
//$elems = get_post_meta($post->ID,'_prop_finance', true);
//$legal = get_post_meta($post->ID,'_prop_legal', true);
if($elems):
?>
<div class="block">
    <div class="block-title">
        <h3 class="title is-4">
            <?php echo __('Financiamiento', 'tnb'); ?>
        </h3>
    </div>
    <div class="block-content">

        <?php
        //pr($elems);
        if($elems):
            echo '<ul class="list-unstyled list-2-cols">';
            foreach ( $elems as $elem ) {
                echo $elem ? sprintf('<li><i class="icon-check"></i> %s</li>', $elem) : '';
            }
            echo '</ul>';
        endif;
        ?>
        <?= $legal ? wpautop($legal) : '' ?>
    </div>
</div>
<?php endif; ?>
