<?php
/*
 * Register a Custom Post Type (Vehículos)
 */
add_action('init', 'vechicle_init');

function vechicle_init() {
    $labels = array(
        'name'               => _x('Vehículos', 'post type general name'),
        'singular_name'      => _x('Vehículo', 'post type singular name'),
        'add_new'            => _x('Agregar Nuevo', 'propiedades'),
        'add_new_item'       => __('Agregar Nuevo vehículo'),
        'edit_item'          => __('Editar vehículo'),
        'new_item'           => __('Nueva vehículo'),
        'view_item'          => __('Ver vehículo'),
        'search_items'       => __('Buscar vehículos'),
        'not_found'          => __('No se encontraron vehículos'),
        'not_found_in_trash' => __('No se encontraron vehículos en la papelera'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Vehículos'
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        //'show_in_nav_menus'  => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => 'vehicle',
        'hierarchical'       => false,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-car',
        'supports'           => array('title', 'editor', 'thumbnail'),
        //'show_in_rest'       => true,
        'taxonomies'         => array('format', 'brand', 'status')
    );
    register_post_type('vehicle', $args);
}

/* Update galeria Messages */
add_filter('post_updated_messages', 'propiedades_updated_messages');

function propiedades_updated_messages($messages) {
    global $post, $post_ID;
    $messages['propiedad'] = array(
        0 => '',
        1 => sprintf(__('Vehículo actualizad.'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field actualizado.'),
        3 => __('Custom field deleted.'),
        4 => __('Vehículo actualizad.'),
        5 => isset($_GET['revision']) ? sprintf(__('Vehículo restaurado de revisión desde %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Vehículo publicado.'), esc_url(get_permalink($post_ID))),
        7 => __('Vehículo guardado.'),
        8 => sprintf(__('Vehículo publicado.'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Vehículo archivado para: <strong>%1$s</strong>. '), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Vehículo actualizado en borrador.'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );
    return $messages;
}

/* Update galeria Help
add_action('contextual_help', 'propiedades_help_text', 10, 3);
    function propiedades_help_text($contextual_help, $screen_id, $screen) {
    if ('propiedades' == $screen->id) {
        $contextual_help =
        '<p>' . __('Cosas para recordar a la hora de agregar un galería:') . '</p>' .
        '<ul>' .
        '<li>' . __('Darle un título al galería. El título sea usado como cabecera del galería') . '</li>' .
        '<li>' . __('Agregar una imagen destacada para darle el fondo al galería.') . '</li>' .
        '<li>' . __('Agregar texto. El texto aparecerá en cada galeria durante la transición.') . '</li>' .
        '</ul>';
    }
    elseif ('edit-propiedades' == $screen->id) {
        $contextual_help = '<p>' . __('Una lista de todos los galerias aparece debajo. para editar un galeria haga click en el título.') . '</p>';
    }
    return $contextual_help;
}
*/

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_vehicle_taxonomies', 0 );

function create_vehicle_taxonomies() {

    // Formato: Camioneta, deportivo, auto, pickup
    $labels = array(
        'name'                       => _x( 'Formato', 'taxonomy general name' ),
        'singular_name'              => _x( 'Formato', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar formatos' ),
        'popular_items'              => __( 'Formatos populares' ),
        'all_items'                  => __( 'Todas las formatos' ),
        'parent_item'                => __( 'Formato padre' ),
        'parent_item_colon'          => __( 'Formato padre:' ),
        'edit_item'                  => __( 'Editar formato' ),
        'update_item'                => __( 'Actualizar formato' ),
        'add_new_item'               => __( 'Agregar formato' ),
        'new_item_name'              => __( 'Nombre del formato' ),
        'separate_items_with_commas' => __( 'Separar los formatos con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar formatos' ),
        'choose_from_most_used'      => __( 'Elige de los formatos más populares' ),
        'not_found'                  => __( 'No se encontraron formatos' ),
        'menu_name'                  => __( 'Formatos' ),
        'back_to_items'              => __( '← Volver a formatos', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => false,
        //'show_in_quick_edit'    => false,
        //'meta_box_cb'           => false,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'format' ),
        //'description'           => __('Definimos formatos como "en construccion", "apta credito", "en sucesion", etc.'),
    );

    register_taxonomy( 'format', 'propiedad', $args );
    /*
    $labels = array(
        'name'                       => _x( 'Tipo', 'taxonomy general name' ),
        'singular_name'              => _x( 'Tipo', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar tipo de vehículo' ),
        'popular_items'              => __( 'Tipos de vehículos populares' ),
        'all_items'                  => __( 'Todos los tipos de vehículos' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Editar tipo de vehículo' ),
        'update_item'                => __( 'Actualizar tipo de vehículo' ),
        'add_new_item'               => __( 'Agregar nuevo tipo de vehículo' ),
        'new_item_name'              => __( 'Nombre del tipo de vehículo' ),
        'separate_items_with_commas' => __( 'Separar los tipos de vehículo con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar tipos de vehículo' ),
        'choose_from_most_used'      => __( 'Elige de los tipos de vehículos más populares' ),
        'not_found'                  => __( 'No se encontraron tipos de vehículo' ),
        'menu_name'                  => __( 'Tipo' ),
        'back_to_items'              => __( '← Volver a Tipos', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        'show_in_quick_edit'    => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'tipo' ),
    );

    register_taxonomy( 'type', 'vehícle', $args );
    */

    /*
    // Operación: Compra, venta, inversión, etc.
    // de momento en jirocar la unica operacion es VENTA
    $labels = array(
        'name'                       => _x( 'Operaciones', 'taxonomy general name' ),
        'singular_name'              => _x( 'Tipo de operación', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar operaciones' ),
        'popular_items'              => __( 'Operaciones populares' ),
        'all_items'                  => __( 'Todas las operaciones' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Editar operación' ),
        'update_item'                => __( 'Actualizar operación' ),
        'add_new_item'               => __( 'Agregar operación' ),
        'new_item_name'              => __( 'Nombre del tipo de operación' ),
        'separate_items_with_commas' => __( 'Separar los tipos de operación con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar tipos de operación' ),
        'choose_from_most_used'      => __( 'Elige de las operaciones más populares' ),
        'not_found'                  => __( 'No se encontraron tipos de operación' ),
        'menu_name'                  => __( 'Operaciones' ),
        'back_to_items'              => __( '← Volver a Operaciones', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'operation' ),
    );

    register_taxonomy( 'operation', 'vehicle', $args );
    */

    // Marcas: Toyota, Subaru, etc.
    $labels = array(
        'name'                       => _x( 'Marca', 'taxonomy general name' ),
        'singular_name'              => _x( 'Marca', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar marcas' ),
        'popular_items'              => __( 'Marcas populares' ),
        'all_items'                  => __( 'Todas las marcas' ),
        'parent_item'                => __( 'Marca padre' ),
        'parent_item_colon'          => __( 'Marca padre:' ),
        'edit_item'                  => __( 'Editar marca' ),
        'update_item'                => __( 'Actualizar marca' ),
        'add_new_item'               => __( 'Agregar marca' ),
        'new_item_name'              => __( 'Nombre de la marca' ),
        'separate_items_with_commas' => __( 'Separar las marcas con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar marcas' ),
        'choose_from_most_used'      => __( 'Elige de las marcas más populares' ),
        'not_found'                  => __( 'No se encontraron marcas' ),
        'menu_name'                  => __( 'Marcas' ),
        'back_to_items'              => __( '← Volver a Marcas', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        //'show_in_quick_edit'    => false,
        //'meta_box_cb'           => false,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'brand' ),
        //'description'           => __('Vamos a usar marcaes para localizar las propiedades, tanto Ciudad como Zona barrio, etc.'),
    );

    register_taxonomy( 'brand', 'vehicle', $args );



    // Condición Nuevo / Usado
    $labels = array(
        'name'                       => _x( 'Condición', 'taxonomy general name' ),
        'singular_name'              => _x( 'Condición', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar estados' ),
        'popular_items'              => __( 'Condiciones populares' ),
        'all_items'                  => __( 'Todas las condiciones' ),
        'parent_item'                => __( 'Condición padre' ),
        'parent_item_colon'          => __( 'Condición padre:' ),
        'edit_item'                  => __( 'Editar condición' ),
        'update_item'                => __( 'Actualizar condición' ),
        'add_new_item'               => __( 'Agregar condición' ),
        'new_item_name'              => __( 'Nombre de condición' ),
        'separate_items_with_commas' => __( 'Separar condiciones con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar condiciones' ),
        'choose_from_most_used'      => __( 'Elige condiciones más populares' ),
        'not_found'                  => __( 'No se encontraron condiciones' ),
        'menu_name'                  => __( 'Condiciones' ),
        'back_to_items'              => __( '← Volver a condiciones', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => false,
        //'show_in_quick_edit'    => false,
        //'meta_box_cb'           => false,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'status' ),
        //'description'           => __('Definimos estados como "en construccion", "apta credito", "en sucesion", etc.'),
    );

    register_taxonomy( 'status', 'vehicle', $args );



    // Condición Nuevo / Usado
    $labels = array(
        'name'                       => _x( 'Interior', 'taxonomy general name' ),
        'singular_name'              => _x( 'Interior', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar detalles de interior' ),
        'popular_items'              => __( 'Detalles de interior populares' ),
        'all_items'                  => __( 'Todas los detalles de interior' ),
        'parent_item'                => __( 'Detalle de interior padre' ),
        'parent_item_colon'          => __( 'Detalle de interior padre:' ),
        'edit_item'                  => __( 'Editar detalle de interior' ),
        'update_item'                => __( 'Actualizar detalle de interior' ),
        'add_new_item'               => __( 'Agregar detalle de interior' ),
        'new_item_name'              => __( 'Nombre del detalle interior' ),
        'separate_items_with_commas' => __( 'Separar los detalles de interior con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar detalles de interior' ),
        'choose_from_most_used'      => __( 'Elige de los detalles de interior más populares' ),
        'not_found'                  => __( 'No se encontraron detalles' ),
        'menu_name'                  => __( 'Interior' ),
        'back_to_items'              => __( '← Volver a interiores', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        //'show_in_quick_edit'    => false,
        //'meta_box_cb'           => false,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'interior' ),
        //'description'           => __('Definimos estados como "en construccion", "apta credito", "en sucesion", etc.'),
    );

    register_taxonomy( 'interior', 'vehicle', $args );

    // Condición Nuevo / Usado
    $labels = array(
        'name'                       => _x( 'Adicionales', 'taxonomy general name' ),
        'singular_name'              => _x( 'Adicionales', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar adicionales' ),
        'popular_items'              => __( 'Adicionales populares' ),
        'all_items'                  => __( 'Todas los adicionales' ),
        'parent_item'                => __( 'Adicionales padre' ),
        'parent_item_colon'          => __( 'Adicionales padre:' ),
        'edit_item'                  => __( 'Editar adicionales' ),
        'update_item'                => __( 'Actualizar adicionales' ),
        'add_new_item'               => __( 'Agregar adicionales' ),
        'new_item_name'              => __( 'Nombre del adicional' ),
        'separate_items_with_commas' => __( 'Separar adicionales con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar adicionales' ),
        'choose_from_most_used'      => __( 'Elige adicionales más populares' ),
        'not_found'                  => __( 'No se encontraron adicionales' ),
        'menu_name'                  => __( 'Adicionales' ),
        'back_to_items'              => __( '← Volver a adicionales', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        //'show_in_quick_edit'    => false,
        //'meta_box_cb'           => false,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'additional' ),
        //'description'           => __('Definimos estados como "en construccion", "apta credito", "en sucesion", etc.'),
    );

    register_taxonomy( 'additional', 'vehicle', $args );

    /*
    // Formato: Camioneta, deportivo, auto, pickup
    $labels = array(
        'name'                       => _x( 'Formato', 'taxonomy general name' ),
        'singular_name'              => _x( 'Formato', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar formatos' ),
        'popular_items'              => __( 'Formatos populares' ),
        'all_items'                  => __( 'Todas las formatos' ),
        'parent_item'                => __( 'Formato padre' ),
        'parent_item_colon'          => __( 'Formato padre:' ),
        'edit_item'                  => __( 'Editar formato' ),
        'update_item'                => __( 'Actualizar formato' ),
        'add_new_item'               => __( 'Agregar formato' ),
        'new_item_name'              => __( 'Nombre del formato' ),
        'separate_items_with_commas' => __( 'Separar los formatos con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar formatos' ),
        'choose_from_most_used'      => __( 'Elige de los formatos más populares' ),
        'not_found'                  => __( 'No se encontraron formatos' ),
        'menu_name'                  => __( 'Formatos' ),
        'back_to_items'              => __( '← Volver a formatos', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'format' ),
        //'description'           => __('Definimos formatos como "en construccion", "apta credito", "en sucesion", etc.'),
    );

    register_taxonomy( 'format', 'propiedad', $args );
    */

    /*
    $labels = array(
        'name'                       => _x( 'Estado', 'taxonomy general name' ),
        'singular_name'              => _x( 'Estado', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar estados' ),
        'popular_items'              => __( 'Estados populares' ),
        'all_items'                  => __( 'Todas los estados' ),
        'parent_item'                => __( 'Estado padre' ),
        'parent_item_colon'          => __( 'Estado padre:' ),
        'edit_item'                  => __( 'Editar estado' ),
        'update_item'                => __( 'Actualizar estado' ),
        'add_new_item'               => __( 'Agregar estado' ),
        'new_item_name'              => __( 'Nombre del estado' ),
        'separate_items_with_commas' => __( 'Separar los estados con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar estados' ),
        'choose_from_most_used'      => __( 'Elige de los estados más populares' ),
        'not_found'                  => __( 'No se encontraron estados' ),
        'menu_name'                  => __( 'Estados' ),
        'back_to_items'              => __( '← Volver a Estados', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'status' ),
        'description'           => __('Definimos estados como "en construccion", "apta credito", "en sucesion", etc.'),
    );

    register_taxonomy( 'status', 'propiedad', $args );
    */

    /*
    // Prestaciones (Patio, Baño, Etc)
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Prestaciones', 'taxonomy general name' ),
        'singular_name'              => _x( 'Prestación', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar prestaciones' ),
        'popular_items'              => __( 'prestaciones populares' ),
        'all_items'                  => __( 'Todas las prestaciones' ),
        'parent_item'                => __( 'Prestación padre' ),
        'parent_item_colon'          => __( 'Prestación padre:' ),
        'edit_item'                  => __( 'Editar prestación' ),
        'update_item'                => __( 'Actualizar prestación' ),
        'add_new_item'               => __( 'Agregar prestación' ),
        'new_item_name'              => __( 'Nombre de la prestación' ),
        'separate_items_with_commas' => __( 'Separar las prestaciones con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar prestaciones' ),
        'choose_from_most_used'      => __( 'Elige de las prestaciones más populares' ),
        'not_found'                  => __( 'No se encontraron prestaciones' ),
        'menu_name'                  => __( 'Prestaciones' ),
        'back_to_items'              => __( '← Volver a Prestaciones', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'features' ),
        'description'           => __('Definimos prestaciones como "patio", "balcón", etc.'),
    );

    register_taxonomy( 'features', 'propiedad', $args );
    */

    /*
    // Servicios (Agua, luz, gas)
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Servicios', 'taxonomy general name' ),
        'singular_name'              => _x( 'Servicio', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar servicios' ),
        'popular_items'              => __( 'Servicios populares' ),
        'all_items'                  => __( 'Todas los servicios' ),
        'parent_item'                => __( 'Servicio padre' ),
        'parent_item_colon'          => __( 'Servicio padre:' ),
        'edit_item'                  => __( 'Editar servicio' ),
        'update_item'                => __( 'Actualizar servicio' ),
        'add_new_item'               => __( 'Agregar servicio' ),
        'new_item_name'              => __( 'Nombre del servicio' ),
        'separate_items_with_commas' => __( 'Separar los servicios con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar servicio' ),
        'choose_from_most_used'      => __( 'Elige de los servicios más populares' ),
        'not_found'                  => __( 'No se encontraron servicios' ),
        'menu_name'                  => __( 'Servicios' ),
        'back_to_items'              => __( '← Volver a Servicios', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        //'show_in_quick_edit'    => false,
        //'meta_box_cb'           => false,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'services' ),
        'description'           => __('Definimos servicios como "agua corriente", "electricidad", etc.'),
    );

    register_taxonomy( 'services', 'propiedad', $args );
    */

    /*
    $labels = array(
        'name'                       => _x( 'Etiquetas', 'taxonomy general name' ),
        'singular_name'              => _x( 'Etiquetas', 'taxonomy singular name' ),
        'search_items'               => __( 'Buscar etiquetas' ),
        'popular_items'              => __( 'Etiquetass populares' ),
        'all_items'                  => __( 'Todas las etiquetas' ),
        'parent_item'                => __( 'Etiqueta padre' ),
        'parent_item_colon'          => __( 'Etiqueta padre:' ),
        'edit_item'                  => __( 'Editar etiqueta' ),
        'update_item'                => __( 'Actualizar etiqueta' ),
        'add_new_item'               => __( 'Agregar etiqueta' ),
        'new_item_name'              => __( 'Nombre de la etiqueta' ),
        'separate_items_with_commas' => __( 'Separar las etiquetas con comas' ),
        'add_or_remove_items'        => __( 'Agregar o quitar etiquetas' ),
        'choose_from_most_used'      => __( 'Elige de las etiquetas más populares' ),
        'not_found'                  => __( 'No se encontraron etiquetas' ),
        'menu_name'                  => __( 'Etiquetas' ),
        'back_to_items'              => __( '← Volver a Etiquetas', 'tnb' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'show_in_nav_menus'     => true,
        //'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'tag' ),
        'description'           => __('Definimos estados como "en construccion", "apta credito", "en sucesion", etc.'),
    );

    register_taxonomy( 'tag', 'propiedad', $args );
    */
}



/*  METABOX */

// custom metaboxes
// Start with an underscore to hide fields from custom fields list
$prefix = '_prop_';

/**
 * Define the metabox and field configurations.
 */
function cmb2_prop_base() {

    $prefix = '_prop_';

    /**
     * Initiate the metabox
     */

    /* CMB ==================================== */
    $cmb = new_cmb2_box( array(
        'id'            => 'op_metabox',
        'title'         => __( 'Detalles de la publicación', 'tnb' ),
        'object_types'  => array( 'vehicle' ), // post type
        //'show_on'       => array( 'key' => 'page-template', 'value' => 'page-products.php' ),
        'context'       => 'side',
        //'context'       => 'normal',
        'priority'      => 'default',
        //'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    /*
    $cmb->add_field( array(
        'name'     => 'Elija el tipo de operación',
        'desc'     => 'Venta, Alquiler, etc.',
        'id'       => $prefix .'operacion',
        'taxonomy' => 'operacion',
        'select_all_button' => false,
        'type'     => 'taxonomy_multicheck',
        // Optional:
        'options' => array(
            'no_terms_text' => __('Lo sentimos, no encontramos un tipo de operación, agregue uno')
        ),
    ) );
    $cmb->add_field( array(
        'name'    => 'Valor',
		'desc'    => '(Solo se muestra en caso de que la operación sea venta)',
		'id'      => $prefix .'price_sale',
		'type'    => 'currency_price',
    ) );
    */
    $cmb->add_field( array(
        'name'              => 'Marca',
        'id'                => $prefix .'brand',
        'taxonomy'          => 'brand',
        'type'              => 'taxonomy_select',
        // Optional:
        'options' => array(
            'no_terms_text' => __('Agregue una marca')
        ),
    ) );
    $cmb->add_field( array(
        'name'     => 'Valor Venta',
        //'desc'     => '(Solo se muestra en caso de que la operación sea venta)',
        'id'       => $prefix .'price_sale',
        //'type'     => 'text',
        //'attributes' => array(
        //    'type' => 'number',
        //    'pattern' => '\d*',
        //),
        //'sanitization_cb' => 'absint',
        //'escape_cb'       => 'absint',
        //'escape_cb'       => 'intval',
        'type'             => 'text_money',
        'before_field'     => 'U$D',
    ) );
    $cmb->add_field( array(
        'name'             => 'Destacado',
        'id'               => $prefix .'featured',
        'desc'             => 'Marcar como unidad destacada',
        'type'             => 'checkbox',
    ) );
}

add_action( 'cmb2_init', 'cmb2_prop_base' );

/*
function cmb2_prop_address() {

    $prefix = '_prop_';

    // CMB2 ====================================

    $cmb2 = new_cmb2_box( array(
        'id'            => 'prop_metabox',
        'title'         => __( 'Información de la propiedad', 'tnb' ),
        'object_types'  => array( 'propiedad' ), // post type
        //'show_on'       => array( 'key' => 'page-template', 'value' => 'page-products.php' ),
        'context'       => 'normal',
        'priority'      => 'low',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $cmb2->add_field( array(
        'name'     => 'Dirección',
        'id'       => $prefix .'address',
        'type'     => 'text',
    ) );

    $cmb2->add_field( array(
        'name'     => 'Extra',
        'desc'     => 'Por si se desea agregar 1er piso A, Contrafrente, etc.',
        'id'       => $prefix .'extra',
        'type'     => 'text',
    ) );
}

add_action( 'cmb2_init', 'cmb2_prop_address' );
*/

function cmb2_prop_details() {

    $prefix = '_prop_';

    /* CMB3 ==================================== */

    $cmb3 = new_cmb2_box( array(
        'id'            => 'detail_metabox',
        'title'         => __( 'Detalles del vehículo', 'tnb' ),
        'object_types'  => array( 'vehicle' ), // post type
        //'show_on'       => array( 'key' => 'page-template', 'value' => 'page-products.php' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ));
    $cmb3->add_field( array(
        'name'              => 'Condición',
        'id'                => $prefix .'status',
        'desc'              => __('Nuevo, Usado, etc', 'tnb'),
        'taxonomy'          => 'status',
        'type'              => 'taxonomy_select',
        // Optional:
        'options' => array(
            'no_terms_text' => __('No encontramos condiciones de venta, agregue una', 'tnb') // Change default text. Default: "No terms"
        ),
    ) );
    $cmb3->add_field( array(
        'name'     => 'Formato',
        'desc'     => 'Auto, Camioneta, Deportivo, Pick-Up, etc.',
        'id'       => $prefix .'format',
        'taxonomy' => 'format',
        'type'     => 'taxonomy_select',
        // Optional:
        'options' => array(
            'no_terms_text' => __('No encontramos ningun formato, agregue uno', 'tnb')
        ),
    ) );
    $cmb3->add_field( array(
        'name'              => 'Motor',
        'id'                => $prefix .'motor',
        //'id'                => $prefix .'motor',
        'type'              => 'text_small',
        'after_field'       => ' cm<sup>3</sup>',
        'attibutes'         => array(
            'placeholder' => '1600',
        )
    ));
    $cmb3->add_field( array(
        'name'              => 'Año',
        'id'                => $prefix .'año',
        'type'              => 'text_small',
        'attibutes'         => array(
            'placeholder'   => '2019',
        )
    ));
    $cmb3->add_field( array(
    	'name'              => 'Transmisión',
    	'id'                => $prefix .'transmision',
    	'type'              => 'select',
        'select_all_button' => true,
        //'default'         => set_default_transmision(true),
    	'options'           => transmision(),
        //'default_cb'        => 'set_default_services',
    ));
    $cmb3->add_field( array(
    	'name'              => 'Combustible',
    	'id'                => $prefix .'combustible',
    	'type'              => 'select',
        'select_all_button' => true,
        //'default'         => set_default_combustible(true),
    	'options'           => combustible(),
        //'default_cb'        => 'set_default_services',
    ));

    $cmb3->add_field( array(
        'name'        => 'Interior',
        'id'          => $prefix . 'interior',
        //'type'        => 'tags_sortable',
        'taxonomy'    => 'interior',
        'type'        => 'default_tags',
        //'type'        => 'taxonomy_multicheck',
        //'type'        => 'text',
        //'repeatable'  => true,
        //'text' => array(
        //    'add_row_text' => 'Agregar',
        //),
    ) );

    $cmb3->add_field( array(
        'name'        => 'Adicionales',
        'id'          => $prefix . 'additional',
        'taxonomy'    => 'additional',
        'type'        => 'default_tags',
        //'type'        => 'textarea',
        //'repeatable'  => true,
        //'text' => array(
        //    'add_row_text' => 'Agregar',
        //),
    ) );
    $cmb3->add_field( array(
    	'name'              => 'Financiación',
    	'id'                => $prefix .'financiation',
        'taxonomy'          => 'financiation', //Enter Taxonomy Slug
    	'type'              => 'taxonomy_multicheck',
        'select_all_button' => true,
        'text'              => array(
            'no_terms_text' => __('No encontramos ningún tipo de financiación') // Change default text. Default: "No terms"
        ),
        'remove_default' => 'true',
        //'default'           => set_default_services(true),
    	//'options'           => services(),
        //'options_cb'        => 'get_service_list'
        //'default_cb'        => 'set_default_services',
    ));
    /*
    AMBIENTES
    $cmb3->add_field( array(
        'name'        => 'Ambientes',
        'id'          => $prefix . 'rooms',
        'type'        => 'text',
        'sanitization_cb' => 'sanitize_int',
        'attributes'  => array(
            'type'    => 'number',
            'pattern' => '\d*',
        ),
    ) );
    $cmb3->add_field( array(
        'name'        => 'Superficie',
        'desc'        => 'en Metros Cuadrados',
        'id'          => $prefix . 'sup',
        'type'        => 'text',
        'sanitization_cb' => 'sanitize_int',
        'attributes'  => array(
            'type'    => 'number',
            'pattern' => '\d*',
        ),
    ) );
    $cmb3->add_field( array(
        'name'        => 'Antigüedad',
        'desc'        => 'Antiguedad de la propiedad (en años)',
        'id'          => $prefix . 'time',
        'type'        => 'text',
        'sanitization_cb' => 'sanitize_int',
        'attributes'  => array(
            'type'    => 'number',
            'pattern' => '\d*',
        ),
    ) );
    $cmb3->add_field( array(
        'name'        => 'Dormitorios',
        'id'          => $prefix . 'dormrooms',
        'type'        => 'text',
        'default'     => 1,
        'sanitization_cb' => 'sanitize_int',
        'attributes'  => array(
            'type'    => 'number',
            'pattern' => '\d*',
        ),
    ) );
    $cmb3->add_field( array(
        'name'        => 'Baños',
        'id'          => $prefix . 'bathrooms',
        'type'        => 'text',
        'default'     => 1,
        'sanitization_cb' => 'sanitize_int',
        'attributes'  => array(
            'type'    => 'number',
            'pattern' => '\d*',
        ),
    ) );
    $cmb3->add_field( array(
        'name'        => 'Garage',
        'id'          => $prefix . 'garage',
        'type'        => 'text',
        'sanitization_cb' => 'sanitize_int',
        'attributes'  => array(
            'type'    => 'number',
            'pattern' => '\d*',
        ),
    ) );
    $cmb3->add_field( array(
        'name'           => 'Prestaciones',
        'id'             => $prefix .'features',
        'taxonomy'       => 'features', //Enter Taxonomy Slug
	    'type'           => 'taxonomy_multicheck',
        //'select_all_button' => false,
        'text'           => array(
            'no_terms_text' => __('Lo sentimos, no encontramos ninguna prestación, agregue una') // Change default text. Default: "No terms"
        ),
	    'remove_default' => 'true', // Removes the default metabox provided by WP core.
	    // Optionally override the args sent to the WordPress get_terms function.
        'query_args' => array(
		// 'orderby' => 'slug',
		// 'hide_empty' => true,
	    ),
        'options_cb' => 'get_service_list'
    ));
    $cmb3->add_field( array(
    	'name'              => 'Servicios',
    	'id'                => $prefix .'services',
    	'type'              => 'multicheck',
        'select_all_button' => true,
        //'default'           => set_default_services(true),
    	'options'           => services(),
        'default_cb'        => 'set_default_services',
    ));*/

    /*
    $cmb3->add_field( array(
    	'name'              => 'Servicios',
    	'id'                => $prefix .'services',
        'taxonomy'          => 'services', //Enter Taxonomy Slug
    	'type'              => 'taxonomy_multicheck',
        'select_all_button' => true,
        'text'              => array(
            'no_terms_text' => __('Lo sentimos, no encontramos ningún servicio cargado, agregue una') // Change default text. Default: "No terms"
        ),
        //'default'           => set_default_services(true),
    	//'options'           => services(),
        'options_cb'        => 'get_service_list'
        //'default_cb'        => 'set_default_services',
    ));
    $cmb3->add_field( array(
    	'name'              => 'Estado',
    	'id'                => $prefix .'status',
    	'type'              => 'multicheck',
        'select_all_button' => false,
        'options'           => status(),
        //'options' => array(
    	//	1 => 'En construcción',
    	//	2 => 'Apta crédito',
    	//	3 => 'En Sucesión',
    	//),
    ));
    */

    /*
    $cmb3->add_field( array(
    	'name'              => 'Orientación',
    	'id'                => $prefix .'orientation',
    	'type'              => 'select',
        'show_option_none'  => true,
        'options'           => orientation(),
    ));
    $cmb3->add_field( array(
    	'name'              => 'Ubicación',
    	'id'                => $prefix .'front',
    	'type'              => 'select',
        'show_option_none'  => true,
        'options'           => front(),
    ));
    */


}

add_action( 'cmb2_init', 'cmb2_prop_details' );

function cmb2_gallery() {
    $prefix = '_prop_';
    $cmb4 = new_cmb2_box( array(
        'id'            => 'gallery_metabox',
        'title'         => __( 'Galería de imágenes', 'tnb' ),
        'object_types'  => array( 'vehicle' ), // post type
        //'show_on'       => array( 'key' => 'page-template', 'value' => 'page-products.php' ),
        //'context'       => 'normal',
        //'priority'      => 'low',
        'context'       => 'side',
        //'context'       => 'normal',
        'priority'      => 'low',
        //'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $cmb4->add_field( array(
        'name' => 'Imágenes',
        'desc' => 'Subir y administrar imágenes',
        'id'   => '_prop_images',
        //'id'   => $prefix . 'images',
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
	           'add_upload_files_text' => 'Agregar Imágenes', // default: "Add or Upload Files"
	            'remove_image_text' => 'Eliminar', // default: "Remove Image"
	            'file_text' => 'Archivo:', // default: "File:"
	            'file_download_text' => 'Descarga', // default: "Download"
	            'remove_text' => 'Eliminar', // default: "Remove"
        ),
    ));
}
add_action( 'cmb2_init', 'cmb2_gallery' );





/*
function sanitize_int( $value, $field_args, $field ) {
	// Don't keep anything that's not numeric
	if ( ! is_numeric( $value ) ) {
		$sanitized_value = '';
	} else {
		// Ok, let's clean it up.
		$sanitized_value = absint( $value );
	}
	return $sanitized_value;
}
function sanitize_money( $value, $field_args, $field ) {

    //$sanitized_value = absint( $value );
    $sanitized_value = number_format( $value, 2, ',', '.');

    return $sanitized_value;
}
//function set_default_services($default) {
//    return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
//}
function set_default_services() {
    return array(1,2,3);
}

function get_service_list() {
  $taxonomy_list = array();
  $taxonomy_query = get_terms(array(
    'taxonomy'   => 'features',
    'hide_empty' => false //you can change this if you need, chech get_terms() documentation
  ));

  foreach ($taxonomy_query as $taxonomy_term) {
    // creates an array of 'term-slug' => 'Term Name'
    $taxonomy_list[$taxonomy_term->slug] = $taxonomy_term->name;
  }
  return $taxonomy_list;
}
function get_status_list() {
  $taxonomy_list = array();
  $taxonomy_query = get_terms(array(
    'taxonomy'   => 'status',
    'hide_empty' => false //you can change this if you need, chech get_terms() documentation
  ));

  foreach ($taxonomy_query as $taxonomy_term) {
    // creates an array of 'term-slug' => 'Term Name'
    $taxonomy_list[$taxonomy_term->slug] = $taxonomy_term->name;
  }
  return $taxonomy_list;
}
*/


/* agregar logos en marcas */

function brand_taxonomy_metabox() {
    $prefix = 'brand_term_';
    /**
     * Metabox to add fields to categories and tags
     */
    $cmb_term = new_cmb2_box( array(
        'id'               => $prefix . 'data',
        //'title'            => __( 'Propiedades slider', 'tnb' ), // Doesn't output for term boxes
        'object_types'     => array( 'term' ),
        'taxonomies'       => array( 'brand' ),
        'context'       => 'normal',
        'priority'      => 'high',
        //'new_term_section' => true, // Will display in the "Add New Category" section
    ) );


    $cmb_term->add_field( array(
        'name'    => __( 'Image', 'tnb' ),
        //'desc'    => __( 'Tiempo de animacion entre diapositivas (en ms)', 'tnb' ),
        //'default' => __( '5000', 'tnb' ),
        'id'      => $prefix . 'image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Agregar Logo' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            //'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            'type' => array(
                'image/jpg',
             	'image/jpeg',
             	'image/png',
                'image/gif',
            ),
        ),
        'preview_size' => 'thumbnail', // Image size to use when previewing in the admin.
    ) );
}
add_action( 'cmb2_admin_init', 'brand_taxonomy_metabox' );

?>
