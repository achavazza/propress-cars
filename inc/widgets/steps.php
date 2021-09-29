<?php
/**
 * Plugin Name: CMB2 Footer steps
 * Description: A boilerplate for building widgets with CMB2. Early alpha version. NEEDS WORK.
 */

// Exit if accessed directly
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

/**
 * @todo Properly hook in JS events, etc. Fields which require JS are not working.
 * @todo Fix css styling. Probably needs a sep. CSS file enqueued for widgets.
 */
class CMB2_Widget_Req_Steps extends WP_Widget {

	/**
	 * Unique identifier for this widget.
	 *
	 * Will also serve as the widget class.
	 *
	 * @var string
	 */
	protected $widget_slug = 'footer-steps';

	/**
	 * Shortcode name for this widget
	 *
	 * @var string
	 */
	protected static $shortcode = 'footer-steps';

	/**
	 * This widget's CMB2 instance.
	 *
	 * @var CMB2
	 */
	protected $cmb2 = null;

	/**
	 * Array of default values for widget settings.
	 *
	 * @var array
	 */
	protected static $defaults = array();

	/**
	 * Store the instance properties as property
	 *
	 * @var array
	 */
	protected $_instance = array();

	/**
	 * Array of CMB2 fields args.
	 *
	 * @var array
	 */
	protected $cmb2_fields = array();

	/**
	 * Contruct widget.
	 */
	public function __construct() {

		parent::__construct(
			$this->widget_slug,
			esc_html__( 'Requisitos en pasos', 'tnb' ),
			array(
				'classname' => $this->widget_slug,
				'customize_selective_refresh' => true,
				'description' => esc_html__( 'Lista los requisitos en pasos', 'tnb' ),
			)
		);

		self::$defaults = array(
			'title' => __('Requisitos', 'tnb'),
			//'desc'  => '',
			'step_desc'  => '',
			'step_icon'  => '',
            //'image' => '',
			//'color' => '#bada55',
		);

		$this->cmb2_fields = array(
			array(
				'name'   => __( 'Título', 'tnb' ),
				'id_key' => 'title',
				//'id'     => 'title',
                'id'     => 'widget-steps-title',
				'type'   => 'text',
			),
			array(
				'name'       => __('Pasos', 'tnb'),
				'id_key'     => 'step_desc',
				'id'         => 'step_desc',
				'type'       => 'text',
                'repeatable' => true,
			),
			array(
				'name'       => __('Iconos pasos', 'tnb'),
				'id_key'     => 'step_icon',
				'id'         => 'step_icon',
				'type'       => 'file_list',
                'repeatable' => true,
			),
		);

		add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
		add_shortcode( self::$shortcode, array( __CLASS__, 'get_widget' ) );
	}

	/**
	 * Delete this widget's cache.
	 *
	 * Note: Could also delete any transients
	 * delete_transient( 'some-transient-generated-by-this-widget' );
	 */
	public function flush_widget_cache() {
		wp_cache_delete( $this->id, 'widget' );
	}
	/**
	 * Front-end display of widget.
	 *
	 * @param  array  $args      The widget arguments set up when a sidebar is registered.
	 * @param  array  $instance  The widget settings as set by user.
	 */
	public function widget( $args, $instance ) {
		echo self::get_widget( array(
			'args'     => $args,
			'instance' => $instance,
			'cache_id' => $this->id, // whatever the widget id is
		) );
	}
	/**
	 * Return the widget/shortcode output
	 *
	 * @param  array  $atts Array of widget/shortcode attributes/args
	 * @return string       Widget output
	 */
	public static function get_widget( $atts ) {
		$widget = '';
		// Set up default values for attributes
		//$atts = shortcode_atts(
		$attribs = shortcode_atts(
			array(
				// Ensure variables
				'instance'      => array(),
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
				'cache_id'      => '',
				'flush_cache'   => isset( $_GET['delete-trans'] ), // Check for cache-buster
			),
			isset( $atts['args'] ) ? (array) $atts['args'] : (array) $attribs['args'],
			//isset( $atts['args'] ) ? (array) $atts['args'] : array(),
			self::$shortcode
		);

        //pr($attribs);
		$instance = shortcode_atts(
			self::$defaults,
			! empty( $atts['instance'] ) ? (array) $atts['instance'] : $attribs['args'],
			//! empty( $atts['instance'] ) ? (array) $atts['instance'] : array(),
			self::$shortcode
		);

		//pr($atts);
		//pr($defaults);

		/*
		 * If cache_id is not passed, we're not using the widget (but the shortcode),
		 * so generate a hash cache id from the shortcode arguments
		 */
		if ( empty( $atts['cache_id'] ) ) {
			$atts['cache_id'] = md5( serialize( $atts ) );
		}

		// Get from cache unless being requested not to
		$widget = ! $atts['flush_cache']
		? wp_cache_get( $atts['cache_id'], 'widget' )
		: '';

        // If $widget is empty, rebuild our cache
		if ( empty( $widget ) ) {
            //pr($instance);
			$widget = '';

			// Before widget hook
			$widget .= $atts['before_widget'];

			$widget .= '<div class="block">';
			//$widget .= '<div style="background-color:'. esc_attr( $instance['color'] ) .'">';

			// Title
			$widget .= sprintf('<div class="block-title"><h3 class="title is-4">%s</h3></div>', $instance['title']);
            $widget .= '<div class="block-content">';
			//$widget .= ( $instance['title'] ) ? $atts['before_title'] . esc_html( $instance['title'] ) . $atts['after_title'] : '';

            $arr1 = array();
            $arr2 = array();
            //$elems = array_combine( $instance['step_icon'], $instance['step_desc'] );
            foreach($instance['step_icon'] as $step){
                array_push($arr1, array_values($step)[0]);
            };
            foreach($instance['step_desc'] as $step){
                array_push($arr2, $step);

            };
            $elems = array();
            foreach($arr1 as $k1 => $v1) {
                $elems[$k1][] = $v1;
            }

            foreach($arr2 as $k2 => $v2) {
                $elems[$k2][] = $v2 ;
            }
            $widget .= '<ul class="steps">';
            foreach($elems as $elem) {
                $widget .= '<li>';
                $widget .= sprintf('<div><img src="%s" /></div>', array_values($elem)[0]);
                $widget .= sprintf('<span>%s</span>', array_values($elem)[1]);
                $widget .= '</li>';
            }
            $widget .= '</ul>';
            //$arr2 = $instance['step_desc'];
            //pr($arr2);
			//$widget .= pr($elems);
			//$widget .= pr($arr2);

			//$widget .= pr($elems);
			//$widget .= wpautop( wp_kses_post( $instance['desc'] ) );

			$widget .= '</div>';
			$widget .= '</div>';

			// After widget hook
			$widget .= $atts['after_widget'];

			wp_cache_set( $atts['cache_id'], $widget, 'widget', WEEK_IN_SECONDS );

		}
		return $widget;
	}

	/**
	 * Update form values as they are saved.
	 *
	 * @param  array  $new_instance  New settings for this instance as input by the user.
	 * @param  array  $old_instance  Old settings for this instance.
	 * @return array  Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$this->flush_widget_cache();
		$sanitized = $this->cmb2( true )->get_sanitized_values( $new_instance );
		return $sanitized;
	}
	/**
	 * Back-end widget form with defaults.
	 *
	 * @param  array  $instance  Current settings.
	 */
	public function form( $instance ) {
		// If there are no settings, set up defaults
		$this->_instance = wp_parse_args( (array) $instance, self::$defaults );

		$cmb2 = $this->cmb2();

		$cmb2->object_id( $this->option_name );
		CMB2_hookup::enqueue_cmb_css();
		CMB2_hookup::enqueue_cmb_js();
		$cmb2->show_form();
	}

	/**
	 * Creates a new instance of CMB2 and adds some fields
	 * @since  0.1.0
	 * @return CMB2
	 */
	public function cmb2( $saving = false ) {

		// Create a new box in the class
		$cmb2 = new CMB2( array(
			'id'      => $this->option_name .'_box', // Option name is taken from the WP_Widget class.
			'hookup'  => false,
			'show_on' => array(
				'key'   => 'options-page', // Tells CMB2 to handle this as an option
				'value' => array( $this->option_name )
			),
		), $this->option_name );

		foreach ( $this->cmb2_fields as $field ) {

			if ( ! $saving ) {
				$field['id'] = $this->get_field_name( $field['id'] );
			}

			$field['default_cb'] = array( $this, 'default_cb' );

			$cmb2->add_field( $field );
		}

		return $cmb2;
	}

	/**
	 * Sets the field default, or the field value.
	 *
	 * @param  array      $field_args CMB2 field args array
	 * @param  CMB2_Field $field CMB2 Field object.
	 *
	 * @return mixed      Field value.
	 */
	public function default_cb( $field_args, $field ) {
		return isset( $this->_instance[ $field->args( 'id_key' ) ] )
			? $this->_instance[ $field->args( 'id_key' ) ]
			: null;
	}

}

/**
 * Register this widget with WordPress.
 */
function register_wds_widget_reqsteps() {
	register_widget( 'CMB2_Widget_Req_Steps' );
}
add_action( 'widgets_init', 'register_wds_widget_reqsteps' );
?>
