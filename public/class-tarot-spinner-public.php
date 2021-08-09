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
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version     The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/tarot-spinner-public.css',
			[],
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/tarot-spinner-public.js',
			[ 'jquery' ],
			$this->version,
			false
		);

		wp_localize_script(
			$this->plugin_name,
			'tarot_public',
			[
				'redirect_url' => esc_url( get_option( 'tarot_settings' ) ),
			]
		);
	}

	/**
	 * Tarot Spinner Shortcode [tarot_spinner]
	 *
	 * @param $atts
	 * @since 1.1.0
	 * @return string
	 */
	public function tarot_shortcode( $atts ) {
		$options = get_option( 'tarot_tags' );
		$url     = $atts['url'] ?? $options;
		if ( isset( $options ) ) {
			$html = '';
			$html .= '<div class="tarot-spinner"><div class="tarot-main"><div id="tarot-container">';
			foreach ( $options as $option ) {
				$html .= '<div class="item"><img src="' . $option . '" alt="tarrot-cards"></div>';
			}
			$html .= '</div></div>';
			$html .= '<a href="' . $url . '" class="start-button">start</a></div>';

			return $html;
		} else {
			return 'No Image exist';
		}
	} // function

}
