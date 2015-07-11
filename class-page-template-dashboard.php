<?php
/**
 * Page Template Dashboard
 *
 * @package   PTD
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 * @license   GPL-2.0+
 * @link      http://tommcfarlin.com/page-template-dashboard/
 * @copyright 2013 - 2015 Tom McFarlin
 */

/**
 * Page Template Dashboard adds a column to your 'All Pages' dashboard to see which templates
 * your pages are using.
 *
 * @package   PTD
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 */
class Page_Template_Dashboard {

	/*--------------------------------------------*
	 * Attributes
	 *--------------------------------------------*/

	/**
	 * The locale of this plugin.
	 *
	 * @since   1.2.0
	 *
	 * @var     string
	 */
	private $locale;

	/**
	 * Instance of this class.
	 *
	 * @since    1.2.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		} // end if

		return self::$instance;

	} // end get_instance

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 *
	 * @version	1.0
	 * @since	1.0
	 */
	private function __construct() {

		// Load plugin textdomain
		add_action( 'init', array( $this, 'plugin_textdomain' ) );

		// Define the actions and filters
		add_filter( 'manage_pages_columns', array( $this, 'add_template_column' ) );
		add_action( 'manage_pages_custom_column', array( $this, 'add_template_data' ), 10, 2 );

	} // end constructor

	/*--------------------------------------------*
	 * Core Functions
	 *--------------------------------------------*/

	/**
	 * Loads the plugin text domain for translation
	 *
	 * @version	1.0
	 * @since	1.0
	 */
	public function plugin_textdomain() {
		load_plugin_textdomain( 'page-template-dashboard', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
	} // end plugin_textdomain

	/*--------------------------------------------*
	 * Filters
	 *--------------------------------------------*/

	/**
	 * Introduces a new column to the 'Page' dashboard that will be used to render the page template
	 * for the given page.
	 *
	 * @param	array	$page_columns	The array of columns rendering page meta data./
	 * @return	array					The update array of page columns.
	 * @version	1.0
	 * @since	1.0
	 */
	public function add_template_column( $page_columns ) {

		$page_columns['template'] = __( 'Page Template', 'page-template-dashboard-locale' );

		return $page_columns;

	} // end add_template_column

	/*--------------------------------------------*
	 * Actions
	 *--------------------------------------------*/

	/**
	 * Renders the name of the template applied to the current page. Will use 'Default' if no
	 * template is used, but will use the friendly name of the template if one is applied.
	 *
	 * @param   string $column_name The name of the column being rendered
	 * @param   int    $post_id     The row's post ID
	 * @version	1.0
	 * @since   1.0
	 */
	public function add_template_data( $column_name, $post_id ) {

		// If we're looking at our custom column, then let's get ready to render some information.
		if( 'template' == $column_name ) {

			// First, the get name of the template
			$template_name = get_page_template_slug( $post_id );

			// If the file name is empty or the template file doesn't exist (because, say, meta data is left from a previous theme)...
			if( 0 == strlen( trim( $template_name ) ) || ! file_exists( get_stylesheet_directory() . '/' . $template_name ) ) {

				// ...then we'll set it as default
				$template_name = __( 'Default', 'page-template-dashboard-locale' );

			// Otherwise, let's actually get the friendly name of the file rather than the name of the file itself
			// by using the WordPress `get_file_description` function
			} else {

				$template_name = get_file_description( get_stylesheet_directory() . '/' . $template_name );

			} // end if

		} // end if

		// Finally, render the template name
		echo $template_name;

	 } // end add_template_data

} // end class
