<?php
function price_block($ID){

$ops = get_the_terms($ID, 'operacion');

//$prop_currency   = currency()[$data['_prop_currency'][0]];
//$cur_symbol      = $prop_currency ? 'U$S' : '$';

// Set default values for each address key
$price_sale = wp_parse_args( get_post_meta( $ID, '_prop_price_sale', 1 ), array(
	'currency'   => '',
	'value'      => '',
) );
$price_rent = wp_parse_args( get_post_meta( $ID, '_prop_price_rent', 1 ), array(
	'currency'   => '',
	'value'      => '',
) );
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
    <span class="level-left">
        <?php if(!$price_sale && !$price_rent):
            echo '<span class="level-item">';
            echo sprintf('<span>Precio: <strong>%s</strong></span>', __('Consultar'));
            echo '</span>';
        else:
            //if($prop_rent):
            if(has_term('alquiler','operacion')):
                $val = $price_rent['currency'].' '.$price_rent['value'];
                echo '<span class="level-item">';
                echo sprintf('<span class="rent-price" title="Precio de alquiler">%s</span>', $val);
                //<strong>Alquiler: </strong>
                //<?php echo '$'.$prop_rent
                echo '</span>';
            endif;
            //if($prop_sale && $prop_rent):
            if(has_term('alquiler','operacion') && has_term('venta','operacion')):
                echo '<span class="level-item">';
                echo ' | ';
                echo '</span>';
            endif;
            //if($prop_sale):
            if(has_term('venta','operacion')):
                $val = $price_sale['currency'].' '.$price_sale['value'];
                echo '<span class="level-item">';
                echo sprintf('<span class="sale-price" title="Precio de venta">%s</span>', $val);
                //<strong>Venta: </strong>
                //<?php echo $cur_symbol.' '.$prop_sale
                echo '</span>';
            endif;
        endif;
        ?>
    </span>
</span>
<?php
$out = ob_get_contents();
ob_end_clean();
return $out;
}
?>
