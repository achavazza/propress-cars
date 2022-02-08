<?php
/// custom metaboxes
function cmb2_home_news() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'home_news_';
    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'home_news_metabox',
        'title'         => __( 'Noticias destacadas', 'cmb2' ),
        'object_types'  => array( 'post','page' ), // post type
        'show_on'       => array( 'key' => 'page-template', 'value' => 'tpl-home-alt.php' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $cmb->add_field( array(
        'name' => 'Título',
        'id'   => 'news_title',
        'type' => 'text',
    ) );
    $cmb->add_field( array(
        'name'           => 'Tipo de noticias',
        'id'             => 'home_news_taxonomy',
        'taxonomy'       => 'category', //Enter Taxonomy Slug
        'type'           => 'select',
    	// Use a callback to avoid performance hits on pages where this field is not displayed (including the front-end).
    	'options_cb'     => 'cmb2_get_term_options', //ver en custom_functions
    	// Same arguments you would pass to `get_terms`.
    	'get_terms_args' => array(
    		'taxonomy'   => 'category',
    		'hide_empty' => false,
    	),
    ) );
    $cmb->add_field( array(
        'name'           => 'Cantidad de noticias',
        'id'             => 'home_news_cant',
        'type' => 'text',
    	'attributes' => array(
    		'type' => 'number',
    		'pattern' => '\d*',
    	),
    	'sanitization_cb' => 'absint',
        'escape_cb'       => 'absint',
    ) );
}
add_action( 'cmb2_init', 'cmb2_home_news' );

/// custom metaboxes
function cmb2_steps() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'steps_';
    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'steps_metabox',
        'title'         => __( 'Que estas buscando', 'cmb2' ),
        'object_types'  => array( 'post','page' ), // post type
        'show_on'       => array( 'key' => 'page-template', 'value' => array('tpl-home-alt.php','tpl-page-financiacion.php') ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $cmb->add_field( array(
        'name' => 'Título',
        'id'   => 'steps_title',
        'type' => 'text',
    ) );

    $group_field_id = $cmb->add_field( array(
        'id'          => 'cmb_steps_metabox',
        'type'        => 'group',
        'options'     => array(
            'group_title'   => __( 'Paso {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'    => __( 'Agregar', 'cmb' ),
            'remove_button' => __( 'Eliminar', 'cmb' ),
            'sortable'      => true, // beta
        ),
    ) );
    $cmb->add_group_field( $group_field_id, array(
        'name'    => 'Ícono',
        'id'      => 'step_icon',
        'idkey'      => 'step_icon',
        'type'    => 'file',
        'options' => array(
            'url' => false,
        ),
        'preview_size' => 'thumbnail',
    ) );
    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Texto',
        'id'    => 'step_desc',
        'idkey' => 'step_desc',
        'type'  => 'text',
    ) );
    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb->add_group_field( $group_field_id, array(
        'name'  => 'Enlace',
        'id'    => 'step_link',
        'idkey' => 'step_link',
        'type'  => 'text',
    ) );
}
add_action( 'cmb2_init', 'cmb2_steps' );


/// custom metaboxes
function cmb2_reviews() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'reviews_';
    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'reviews_metabox',
        'title'         => __( 'Que estas buscando', 'cmb2' ),
        'object_types'  => array( 'post','page' ), // post type
        'show_on'       => array( 'key' => 'page-template', 'value' => array('tpl-home-alt.php', 'tpl-page-nosotros.php') ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $cmb->add_field( array(
        'name' => 'Título',
        'id'   => 'reviews_title',
        'type' => 'text',
    ) );

    $group_field_id = $cmb->add_field( array(
        'id'          => 'cmb_reviews_metabox',
        'type'        => 'group',
        'options'     => array(
            'group_title'   => __( 'Reseña {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'    => __( 'Agregar', 'cmb' ),
            'remove_button' => __( 'Eliminar', 'cmb' ),
            'sortable'      => true, // beta
        ),
    ) );
    $cmb->add_group_field( $group_field_id, array(
        'name'    => 'Foto',
        'id'      => 'review_picture',
        'idkey'   => 'review_picture',
        'type'    => 'file',
        'options' => array( 'url' => false, ),
        'text'    => array( 'add_upload_file_text' => 'Agregar o editar' ),
        'preview_size' => 'thumbnail',
    ) );
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Nombre',
        'id'    => 'review_name',
        'idkey' => 'review_name',
        'type'  => 'text',
    ) );
    $cmb->add_group_field( $group_field_id, array(
        'name'   => 'Calificación',
        'id'     => 'review_value',
        'idkey'  => 'review_value',
        'type'   => 'select',
        'options'  => array(
            '1' => '*',
            '2' => '**',
            '3' => '***',
            '4' => '****',
            '5' => '*****'
        ),
    ) );
    $cmb->add_group_field( $group_field_id, array(
        'name' => 'Reseña',
        'id'    => 'review_desc',
        'idkey' => 'review_desc',
        'type'  => 'textarea',
    ) );
}
add_action( 'cmb2_init', 'cmb2_reviews' );
 ?>
