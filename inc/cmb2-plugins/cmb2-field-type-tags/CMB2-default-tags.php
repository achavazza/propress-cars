<?php
/**
 * CMB2 Default Tags field/metabox
 *
 * @package CMB2 Default Tags field/metabox
 */

/**
 * Adds a custom field type which uses the WordPress default post-tags metabox.
 *
 * @param  object $field             The CMB2_Field type object.
 * @param  string $value             The saved (and escaped) value.
 * @param  int    $object_id         The current post ID.
 * @param  string $object_type       The current object type.
 * @return void
 */

define( 'CMB_TAGS_URL', dirname(get_stylesheet_uri()).'/inc/cmb2-plugins/cmb2-field-type-tags/' );
define( 'CMB_TAGS_VERSION', '1.0.0' );

function cmb2_render_default_tags_field_type( $field, $escaped_value, $object_id, $object_type ) {

	$taxonomy = $field->args( 'taxonomy' );
	$taxonomy = $taxonomy ? $taxonomy : 'post_tag';

	if ( 'post' !== $object_type ) {
		wp_die( 'This won\'t work for non-"post" object types!' );
	}

    cmb_tags_enqueue();

	wp_enqueue_script( 'tags-box' );
	add_action( 'admin_footer', 'cmb2_init_post_tag_box' );

	post_tags_meta_box( get_post( $object_id ), array(
		'args' => array(
			'taxonomy' => $taxonomy,
		),
	) );
}
add_action( 'cmb2_render_default_tags', 'cmb2_render_default_tags_field_type', 10, 4 );

function cmb2_init_post_tag_box() {
	?>
	<script type="text/javascript">
	jQuery( function( $ ) {
		//window.tagBox && window.tagBox.init();
	});
	</script>
	<?php
}

function cmb2_default_tags_let_wp_save( $null, $a, $field_args, $field ) {
	if ( 'default_tags' === $field->args( 'type' ) ) {
		// Let WP handle it.
		return false;
	}

	return $null;
}
add_filter( 'cmb2_override_meta_save', 'cmb2_default_tags_let_wp_save', 10, 4 );

function cmb2_remove_default_tag_metabox_for_taxonomy() {
	foreach ( CMB2_Boxes::get_all() as $cmb ) {
		foreach ( $cmb->prop( 'fields' ) as $field ) {
			if ( 'default_tags' === $field['type'] ) {
				$taxonomy = isset( $field['taxonomy'] ) ? $field['taxonomy'] : 'post_tag';
				remove_meta_box( "tagsdiv-{$taxonomy}", 'post', 'side' );
			}
		}
	}
}
add_action( 'admin_init', 'cmb2_remove_default_tag_metabox_for_taxonomy' );

// enque scripts
function cmb_tags_enqueue() {
	//wp_enqueue_script( 'cmb_tags_script', CMB_TAGS_URL . 'js/default_tags.js', array( 'jquery', 'jquery-ui-sortable' ), CMB_TAGS_VERSION );
	wp_enqueue_style( 'cmb_tags_stype', CMB_TAGS_URL . 'css/tags.css', array(), CMB_TAGS_VERSION );
}
