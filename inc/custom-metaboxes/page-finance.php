<?php
function cmb2_page_finance() {

    $prefix = '_prop_';

    /* CMB3 ==================================== */

    $cmb = new_cmb2_box( array(
        'id'            => 'page_finance_metabox',
        'title'         => __( 'Opciones de financiacion', 'tnb' ),
        'object_types'  => array( 'post','page' ), // post type
        'show_on'       => array( 'key' => 'page-template', 'value' => array('tpl-home-alt.php','tpl-page-financiacion.php') ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ));
    /*
    $cmb->add_field( array(
        'name'              => 'Financiación',
        'id'                => $prefix .'options',
        'type'    => 'multicheck',
        'options' => array(
            'op1' => 'Calculamos tu cuota en el acto por teléfono o Whatsapp',
            'op2' => 'Tasa desde 14,5%. Regulado por el banco central',
            'op3' => 'Plazo hasta 72 meses *',
            'op4' => 'Hasta el xxx de financiamento*',
        ),
    ));
    $cmb->add_field( array(
        'name'              => 'Financiación',
        'id'                => $prefix .'options2',
        'type'    => 'text_small',
        'default'           => '100',
        'after_field'       => ' %',

    ));
    */
    $cmb->add_field( array(
        'name'              => 'Financiación',
        'id'                => $prefix .'finance',
        'type'              => 'text',
        'default'           => array(
            'Calculamos tu cuota en el acto por teléfono o Whatsapp',
            'Tasa desde 14,5%. Regulado por el banco central',
            'Plazo hasta 72 meses *',
            'Hasta el 100% de financiamento *',
        ),
        'repeatable'        => true
    ));
    $cmb->add_field( array(
        'name'              => 'Legales',
        'id'                => $prefix .'legal',
        'type'              => 'textarea',
        'default'           => array(
            '* Aplican condiciones',
        ),
    ));

}

add_action( 'cmb2_init', 'cmb2_page_finance' );

function cmb2_wa_page_finance() {

    $prefix = '_prop_';

    /* CMB3 ==================================== */

    $cmb2 = new_cmb2_box( array(
        'id'            => 'page_finance_wa_metabox',
        'title'         => __( 'Boton de Whatsapp', 'tnb' ),
        'object_types'  => array( 'post','page' ), // post type
        'show_on'       => array( 'key' => 'page-template', 'value' => array('tpl-page-financiacion.php') ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ));
    $cmb2->add_field( array(
        'name'              => 'Tel Whatsapp',
        'id'                => $prefix .'wa_phone',
        'desc'              => 'Recordar agregar cod internacional (+593)',
        'type'              => 'text',
    ));
    $cmb2->add_field( array(
        'name'              => 'Texto Whatsapp',
        'id'                => $prefix .'wa_text',
        'type'              => 'text',
    ));

}

add_action( 'cmb2_init', 'cmb2_wa_page_finance' );
?>
