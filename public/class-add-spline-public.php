<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://orsbert.com
 * @since      1.0.0
 *
 * @package    Add_Spline
 * @subpackage Add_Spline/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Add_Spline
 * @subpackage Add_Spline/public
 * @author     Orsbert Ayesigye <hello@orsbert.com>
 */
class Add_Spline_Public {

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
		 * defined in Add_Spline_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Add_Spline_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/add-spline-public.css', array(), $this->version, 'all' );

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
		 * defined in Add_Spline_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Add_Spline_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script(
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'js/add-spline-public.js', 
			array( 'jquery' ),
			$this->version, 
			false 
		);

		wp_enqueue_script(
			"{$this->plugin_name}three.min",
			"https://unpkg.com/three@^0.131.0/build/three.min.js",
			array(),
			$this->version,
			true
		);

		wp_enqueue_script(
			"{$this->plugin_name}add-spline-runtime", 
			plugin_dir_url( __FILE__ ) . 'js/add-spline-runtime.js', 
			array("{$this->plugin_name}three.min"),
			$this->version,
			true
		);

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {

		add_shortcode( 'add_spline', [$this, 'insert3dScene'] );

	}

	public function insert3dScene($atts) {
		$a = shortcode_atts( [
			'src' => '',
		], $atts );

		$content = "
			<div class='spline-container'>
				<canvas id='canvas3d'></canvas>					
			</div>
			<script>
				window.addEventListener('load', function () {
					const app = new SpeRuntime.Application();
					app.start('https://my.spline.design/elevator-6fbea3d9970b45818856dc0e7954a97b/scene.json');
				})
			</script>
		";

		return $content;
	}

}
