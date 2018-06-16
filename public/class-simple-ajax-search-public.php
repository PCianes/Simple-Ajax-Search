<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://pablocianes.com
 * @since      1.0.0
 *
 * @package    Simple_Ajax_Search
 * @subpackage Simple_Ajax_Search/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Simple_Ajax_Search
 * @subpackage Simple_Ajax_Search/public
 * @author     Pablo Cianes <pablo@pablocianes.com>
 */
class Simple_Ajax_Search_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for the Public facing functionality.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for ...
		 */
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-simple-ajax-search-class-name.php'; .
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Ajax_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Ajax_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-ajax-search-public.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Ajax_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Ajax_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-ajax-search-public.min.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add ajax input template by the shortcode [ sas-input ]
	 *
	 * @since    1.0.0
	 * @param      array  $atts       Attributes of the shortcode set by user.
	 * @param      string $content   Content of the shortcode set by user.
	 */
	public function add_input_template( $atts, $content = null ) {

		$content  = $content ? sanitize_text_field( $content ) : 'Write here your search...';
		$defaults = array(
			'blank'     => false,
			'dashicons' => 'dashicons-media-document',
			'headings'  => '#29AAE3',
			'checked'   => '#F8931F',
			'unchecked' => '#ccc',
			'not_found' => 'Sorry but there are no results for your search.',
		);

		$atts = shortcode_atts( $defaults, $atts, 'sas-input' );

		$ajax_args = array(
			'ajax_url'  => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( $this->plugin_name . '-nonce' ),
			'target'    => $atts['blank'] ? 'target="_blank"' : '',
			'dashicons' => sanitize_text_field( $atts['dashicons'] ),
			'color_1'   => sanitize_text_field( $atts['headings'] ),
			'color_2'   => sanitize_text_field( $atts['checked'] ),
			'color_3'   => sanitize_text_field( $atts['unchecked'] ),
			'cta'       => '<div id="not_found"><p><strong>' . esc_html( $atts['not_found'] ) . '</strong></p></div>',
		);

		wp_localize_script( $this->plugin_name, 'ajax_object_search', $ajax_args );

		wp_enqueue_script( $this->plugin_name );
		wp_enqueue_style( $this->plugin_name );

		$categories = get_categories();

		ob_start();
			include 'views/simple-ajax-search-public-display.php';
			$template_to_return = ob_get_contents();
		ob_end_clean();

		return $template_to_return;
	}

	/**
	 * Add ajax result template by the shortcode [ sas-result ]
	 *
	 * @since    1.0.0
	 * @param      array  $atts       Attributes of the shortcode set by user.
	 * @param      string $content   Content of the shortcode set by user.
	 */
	public function add_result_template( $atts, $content = null ) {

		$template_to_return = '<div id="sas-result" class="sas-result"></div>';

		return $template_to_return;
	}


	/**
	 * The function to manage the custom search from Ajax.
	 *
	 * @since    1.0.0
	 */
	public function ajax_search() {

		if ( ! check_ajax_referer( $this->plugin_name . '-nonce', 'nonce' ) ) {
			wp_die( 'Error - unable to verify nonce, please try again.' );
		}

		$search     = ! empty( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : false;
		$categories = ! empty( $_POST['categories'] ) ? wp_unslash( $_POST['categories'] ) : false;
		$cat_array  = array();

		if ( empty( $categories ) ) {
			header( 'Content-type: application/json' );
			echo wp_json_encode( false );
			die;
		}

		foreach ( $categories as $category ) {
			$cat_array[] = (int) $category;
		}

		$args = array(
			'post_type'        => 'post',
			'numberposts'      => -1,
			's'                => $search,
			'category__in'     => $cat_array,
			'suppress_filters' => false,
		);

		$posts = get_posts( $args );

		if ( empty( $posts ) ) {
			header( 'Content-type: application/json' );
			echo wp_json_encode( false );
			die;
		}

		$output = array();

		foreach ( $posts as $post ) {
			setup_postdata( $post );

			$categories = get_the_category( $post->ID );

			// in case of post with many categories asign to the first ok into array of search.
			foreach ( $categories as $cat ) {
				if ( ! in_array( $cat->cat_ID, $cat_array, true ) ) {
					continue;
				}
				$category = $cat;
				break;
			}

			$output[ $category->cat_ID ][] = array(
				'title'    => $post->post_title,
				'link'     => get_permalink( $post->ID ),
				'category' => $category->cat_name,
			);
		}

		header( 'Content-type: application/json' );
		echo wp_json_encode( $output );
		die;

	}

}
