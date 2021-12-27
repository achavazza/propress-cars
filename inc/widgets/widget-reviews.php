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
class CMB2_Widget_Reviews extends WP_Widget {

	/**
	 * Unique identifier for this widget.
	 *
	 * Will also serve as the widget class.
	 *
	 * @var string
	 */
	protected $widget_slug = 'jiro-reviews';

	/**
	 * Shortcode name for this widget
	 *
	 * @var string
	 */
	protected static $shortcode = 'jiro-reviews';

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
	protected $fields = array();

	/**
	 * Contruct widget.
	 */
	public function __construct() {

		parent::__construct(
			$this->widget_slug,
			esc_html__( 'Jirocar Reseñas', 'tnb' ),
			array(
				'classname' => $this->widget_slug,
				'customize_selective_refresh' => true,
				'description' => esc_html__( 'Lista multiples reseñas', 'tnb' ),
			)
		);
        /*
		self::$defaults = array(
			'title' => '',
			//'title' => __('Requisitos', 'tnb'),
			//'desc'  => '',
			'step_desc'  => '',
			'step_icon'  => '',
            //'image' => '',
			//'color' => '#bada55',
		);
        */

        $this->fields = array(
            array(
				'name'   => 'Título',
                'id'     => 'steps_title',
				'id_key' => 'steps_title',
				'type'   => 'text',
			),
            array(
                'name'    => 'Reseñas',
                'id'      => 'steps',
                'id_key'  => 'steps',
                'type'    => 'group',
                'fields'  => array(
                    array(
                        'name'   => 'Foto',
        				'id'     => 'review_picture',
        				'id_key' => 'review_picture',
        				'type'   => 'file',
                        'options' => array(
                            'url' => false, // Hide the text input for the url
                        ),
                        'text'    => array(
                            'add_upload_file_text' => 'Agregar o editar' // Change upload button text. Default: "Add or Upload File"
                        ),
                        'preview_size' => 'thumbnail',
                    ),
                    array(
                        'name'   => 'Nombre',
                        'id'     => 'review_name',
        				'id_key' => 'review_name',
        				'type'   => 'text',
                    ),
                    array(
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
                    ),
                    array(
                        'name'   => 'Texto',
                        'id'     => 'review_text',
        				'id_key' => 'review_text',
        				'type'   => 'textarea',
                    ),
                ),
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
		$widget = ! $atts['flush_cache'] ? wp_cache_get( $atts['cache_id'], 'widget' ) : '';

        $instance = $atts['instance'];

        // If $widget is empty, rebuild our cache
		if ( empty( $widget ) ) {
            /*
            $arr1 = array();
            $arr2 = array();
            //$elems = array_combine( $instance['step_icon'], $instance['step_desc'] );
            if($instance['step_icon']){
                foreach($instance['step_icon'] as $step){
                    array_push($arr1, array_values($step)[0]);
                };
            }
            if($instance['step_desc']){
                foreach($instance['step_desc'] as $step){
                    array_push($arr2, $step);

                };
            }
            $elems = array();
            foreach($arr1 as $k1 => $v1) {
                $elems[$k1][] = $v1;
            }

            foreach($arr2 as $k2 => $v2) {
                $elems[$k2][] = $v2 ;
            }
            */

			$widget = '';

			// Before widget hook
			$widget .= $atts['before_widget'];

			$widget .= '<div class="block">';
			// Title
			//$widget .= $instance['steps_title'];
            $widget .= sprintf('<div class="block-title"><h3 class="title is-4">%s</h3></div>', $instance['steps_title']);
            $widget .= '<div class="block-content">';
			//$widget .= ( $instance['steps_title'] ) ? $atts['before_title'] . esc_html( $instance['title'] ) . $atts['after_title'] : '';

            $elems = $instance['steps'];

            $widget .= '<ul>';
            foreach($elems as $elem) {
                $widget .= '<li>';
                $widget .= sprintf('<div><img src="%s" /></div>', $elem['review_picture']);
                $widget .= sprintf('<span>%s</span>', $elem['review_name']);
                $widget .= sprintf('<span>%s</span>', $elem['review_value']);
                $widget .= sprintf('<span>%s</span>', $elem['review_text']);
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
         add_filter( 'cmb2_override_meta_value', array( $this, 'cmb2_override_meta_value' ), 11, 4 );

         // If there are no settings, set up defaults
         $this->_instance = wp_parse_args( (array) $instance, self::$defaults );

         $cmb2 = $this->cmb2();

         $cmb2->object_id( $this->option_name );
         CMB2_hookup::enqueue_cmb_css();
         CMB2_hookup::enqueue_cmb_js();
         $cmb2->show_form();

         remove_filter( 'cmb2_override_meta_value', array( $this, 'cmb2_override_meta_value' ) );
     }

 public function cmb2_override_meta_value( $value, $object_id, $args, $field ) {
         if ( $field->group || 'group' === $field->type() ) {
             if ( isset( $field->args['id_key'] ) ) {
                 $id_key = $field->args['id_key'];

                 if ( isset( $this->_instance[$id_key] ) ) {
                     $value = $this->_instance[$id_key];
                 }
             }
         }

         return $value;
     }
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

             foreach ( $this->fields as $field ) {
                 if ( ! $saving ) {
                     $field['id'] = $this->get_field_name( $field['id'] );
                 }

                 if( $field['type'] == 'group' ) {
                     // Update group fields default_cb
                     foreach( $field['fields'] as $group_field_index => $group_field ) {
                         $group_field['default_cb'] = array( $this, 'default_cb' );

                         $field['fields'][$group_field_index] = $group_field;
                     }
                 }

                 $field['default_cb'] = array( $this, 'default_cb' );

                 $cmb2->add_field( $field );
             }

             return $cmb2;
         }

  public function default_cb( $field_args, $field ) {
             if( $field->group ) {
                 if( isset( $this->_instance[ $field->group->args( 'id_key' ) ] ) ) {
                     $data = $this->_instance[ $field->group->args( 'id_key' ) ];

                     return is_array( $data ) && isset( $data[ $field->group->index ][ $field->args( 'id_key' ) ] )
                         ? $data[ $field->group->index ][ $field->args( 'id_key' ) ]
                         : null;
                 } else {
                     return null;
                 }
             }

             return isset( $this->_instance[ $field->args( 'id_key' ) ] )
                 ? $this->_instance[ $field->args( 'id_key' ) ]
                 : null;
         }

 }

/**
 * Register this widget with WordPress.
 */
function register_wds_widget_jiro_reviews() {
	register_widget( 'CMB2_Widget_Reviews' );
}
add_action( 'widgets_init', 'register_wds_widget_jiro_reviews' );
?>
