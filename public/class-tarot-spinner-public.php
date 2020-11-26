<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/abdullahsajjad
 * @since      1.0.0
 *
 * @package    Tarot_Spinner
 * @subpackage Tarot_Spinner/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tarot_Spinner
 * @subpackage Tarot_Spinner/public
 * @author     Abdullah Sajjad <https://github.com/abdullahsajjad/tarot-spinner>
 */
class Tarot_Spinner_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Tarot_Spinner_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tarot_Spinner_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tarot-spinner-public.css', array(), $this->version, 'all' );

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
		 * defined in Tarot_Spinner_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tarot_Spinner_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tarot-spinner-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script(
			$this->plugin_name,
			'tarot_public',
			array(
				'redirect_url'  => get_option( 'tarot_settings' )
			)
		);
	}

	public function tarot_shortcode($atts) {
		$url = isset($atts['url']) ? $atts['url'] : get_option( 'tarot_settings' );
		$options  = get_option( 'tarot_tags' );
		if( isset( $options ) ) {
			$html = '';
			$html .= '<div class="tarot-spinner"><div class="tarot-main"><div id="tarot-container">';
			foreach ( $options as $option ) {
				$html .= '<div class="item"><img src="' . $option . '" alt="tarrot-cards"></div>';
			}
			$html .= '</div></div>';
			$html .= '<a href="'.$url.'" class="start-button">start</a></div>';

			return $html;
		} else {
			return 'No Image exist';
		}

	}

}
