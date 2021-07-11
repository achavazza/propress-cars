<?php
function price_block($ID){

//$ops = get_the_terms($ID, 'operacion');

//$prop_currency   = currency()[$data['_prop_currency'][0]];
//$cur_symbol      = $prop_currency ? 'U$S' : '$';

// Set default values for each address key
$price_sale = get_post_meta( $ID, '_prop_price_sale')[0];
/*
foreach($data['_prop_price_sale'] as $price){
    pr($price);
};
*/
//$prop_sale       = ($data['_prop_price_sale'][0]!= 0) ? number_format($data['_prop_price_sale'][0], 0, ',', '.') : '';
//$prop_rent       = ($data['_prop_price_rent'][0]!= 0) ? number_format($data['_prop_price_rent'][0], 0, ',', '.') : '';

ob_start();
?>
<?php //echo esc_html($price_sale['currency'] ); ?>
<?php //echo esc_html($price_sale['value'] ); ?>
<span class="price-block level">
        <?php if(!$price_sale):
            echo '<span class="level-item has-text-centered">';
            printf('<span>%s</span>', __('Consultar'));
            echo '</span>';
        else:
            echo '<span class="level-item has-text-centered">';
            printf('<span class="sale-price" title="Precio de venta">%s</span>', $price_sale);
            echo '</span>';
        endif;
        ?>
</span>
<?php
$out = ob_get_contents();
ob_end_clean();
return $out;
}
?>
