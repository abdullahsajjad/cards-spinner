<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://allmarketingsolutions.co.uk/
 * @since      1.0.0
 *
 * @package    Tarot_Spinner
 * @subpackage Tarot_Spinner/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 */
class Tarot_Spinner_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tarot-spinner-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name. '-tags', plugin_dir_url( __FILE__ ) . 'css/jquery.tagsinput.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

        wp_enqueue_script( $this->plugin_name . '-tags', plugin_dir_url( __FILE__ ) . 'js/jquery.tagsinput.js', array( 'jquery' ), $this->version, false );

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tarot-spinner-admin.js', array( 'jquery' ), $this->version, false );

        $options = get_option( 'tarot_tags' );
		wp_localize_script(
			$this->plugin_name,
			'tarot_ajax',
			array(
				'ajaxurl'       => admin_url( 'admin-ajax.php' ),
				'loadingimage'  => plugin_dir_url( __FILE__ ) . 'images/loader.gif',
                'ajax_nonce'    => wp_create_nonce('ff_form'),
                'tags'          => $options ? implode( ',', $options ) : '',
			)
		);

	}
	/**
	 * Adding Options Page
	 *
	 * @since 1.0.0
	 */
	public function tarot_options_page() {

		add_menu_page(  __('Tarot Spinner','tarot-spinner'),
			__('Tarot Spinner','tarot-spinner'),
			'manage_options',
			'tarot-spinner',
			[$this, 'ts_options_page_callback'],
			'dashicons-controls-pause',
			'99'
		);

	}
	/**
	 * Options Page Callback    Displays all the data displayed on admin Facing page
	 *
	 * @since 1.0.0
	 */
	public function ts_options_page_callback() {
		require_once plugin_dir_path( dirname( __FILE__ ) ). 'admin/partials/tarot-spinner-admin-display.php';
	}

	/**
	 * Character Form Ajax Callback
	 *
	 * @hooked wp_ajax_
	 */
	public function tarot_from_callback() {
	    // verifying nonce
        check_ajax_referer('ff_form', 'nonce' );

        $tags_arr = $_POST[ 'tags' ];
		if( isset( $tags_arr ) && is_array( $tags_arr ) ) {
            $tags_arr = filter_var_array($tags_arr, FILTER_SANITIZE_STRING);
            update_option('tarot_tags', $tags_arr);
            wp_send_json( ['result'=>get_option( 'tarot_tags'), 'code'=>200]);
            die();
        } else if( empty( $tags_arr )     ) {
			update_option('tarot_tags', []);
			wp_send_json( ['result'=>'cleared', 'code'=>200]);
			die();
		} else {
			wp_send_json( 'something went Wrong' );
			die();
		}
	}


    /**
     * Updates options array
     *
     * return user entered array if the the options array is empty
     * and add user entered array items at the end of options array
     *
     * @access  private
     * @since   1.0.0
     * @param   $new_arr  array   user enter string converted to array
     * @param   $options  array   options array
     * @return  array
     */
    private function update_options_array( $new_arr, $options )
    {
        if( empty( $options ) ) {
            foreach( $new_arr as $key=>$item ) {
                if( empty( $item ) ) {
                    unset($new_arr[$key]);
                }
            }
            return $new_arr;
        } else {
            foreach ( $new_arr as $item ) {

                // if character exists in options continue
                if ( in_array( $item, $options ) || empty( $item ) ) {
                    continue;
                }
                array_push($options, $item );
            }
        }
        return $options;
    }

	/**
	 * Displays Block words tables
	 *
	 * @hooked tarot_blocked_words
	 * @since 1.0.0
     */
	public function ff_display_word_table() {

		$words = [];
		$rows        = '';
		if( $words = get_option('ff_words') ) {
			foreach ( $words as $word ) {
				$rows .= '<tr class="ff_row">
							<td>'. $word .'</td>
							<td><span id="'. $word .'" class="dashicons dashicons-trash tarot-trash-w"></span></td>
						</tr>';
			}
		} else {
			$rows = 'No Words Added';
		}
		$html = '<table class="ff-w-table">
		<tbody class="ff-w-table-body">
			<tr>
				<th>Blocked Words</th>
			</tr>
			'.$rows.'
		</tbody>
	</table>';

		echo $html;
	}

	/**
	 * Registering Admin Settings
	 *
	 * @hooked admin_init
	 * @access public
	 * @since 1.0.0
	 */
	public function tarot_register_settings() {
		register_setting( 'tarot_settings', 'tarot_settings' );

		add_settings_section(
			'tarot_settings',
			'Tarot Redirect URL',
			[$this,'tarot_settings_callback'],
			'tarot-spinner'
		);

		add_settings_field(
			't_redirect',
			'Redirect URL',
			[$this,'tarot_redirect_field'],
			'tarot-spinner',
			'tarot_settings'

		);
	}

	public function tarot_settings_callback(){
	}
	public function tarot_redirect_field(){
		$settings = get_option( 'tarot_settings' );
		?>
		<input class="t_redirect" name="tarot_settings" value="<?php echo $settings;?>">
		<small class="fence-field-description">Enter URL to redirect</small>
		<?php
	}


}
