<?php
$elems = get_post_meta($post->ID,'_prop_finance', true);
if($elems):
?>
<div class="block">
    <div class="block-title">
        <h3 class="title is-4">
            <?php echo __('Financiación', 'tnb'); ?>
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
    </div>
</div>
<?php endif; ?>
