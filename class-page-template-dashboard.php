<?php
/**
 * Page Template Dashboard
 *
 * @package   PTD
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 * @license   GPL-2.0+
 * @link      https://tommcfarlin.com/view-page-templates/
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

		// Specify width of custom column
		add_action( 'admin_print_styles-edit.php', array( $this, 'columns_width_css' ) );

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
	 * If we're on the pages listing admin page, then add our column
	 *
	 * @since  to-be-updated
	 * @return null
	 */
	public function columns_width_css() {
		$screen = get_current_screen();

		if ( isset( $screen->id ) && 'edit-page' == $screen->id && 'page' == $screen->post_type ) {
			// In case you want to modify the width of the column. Default is 12%
			$col_width = apply_filters( 'page_template_dashboard_column_width', '15%' );

			?>
			<style type="text/css" media="screen">
				#template { width: <?php echo esc_html( $col_width ); ?>; }
			</style>
			<?php
		}
	}

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
		// If we're not looking at our custom column, then bail out
		if ( 'template' != $column_name ) {
			return;
		}

		// Get template slug/name
		$template = self::get_template( $post_id );

		/**
		 * Get the template name if it exists, or fall-back to the slug
		 * This can happen if the page was set to a
		 *
		 * @var [type]
		 */

		// If it exists, let's use the friendly name of the file rather than the name of the file itself
		if ( $template['name'] ) {

			$name = $template['name'];

		} elseif ( $template['slug'] ) {

			// If the template file doesn't exist (because, say, meta data is left from a previous theme), use the file-name
			$name = sprintf( __( '%s<br>(template missing in theme)', 'page-template-dashboard-locale' ), $template['slug'] );

		} else {

			// Otherwise page is using the default template
			$name = __( 'Default', 'page-template-dashboard-locale' );

		} // end if

		// Generate some markup with slug as the title attribute (hover-to-view template file name)
		$html = sprintf( '<span title="%s">%s</span>', esc_attr( $template['slug'] ), $name );

		// Finally, render the template name. Filter allows markup modification
		echo apply_filters( 'page_template_dashboard_markup', $html, $template );

	} // end add_template_data

	/*--------------------------------------------*
	 * Helpers
	 *--------------------------------------------*/

	/**
	 * Get a template name for a page
	 *
	 * @since  to-be-updated
	 * @param  int    $post_id Post ID
	 * @return string          Template name or slug, or empty
	 */
	public static function get_template( $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();

		// First, the get the template slug
		$template      = get_page_template_slug( $post_id );
		// Get all existing theme templates
		$templates     = get_page_templates( $post_id );
		$templates     = is_array( $templates ) ? array_flip( $templates ) : array();
		// Get the template nice-name
		$template_name = array_key_exists( $template, $templates ) ? $templates[ $template ] : '';

		return array( 'slug' => $template, 'name' => $template_name );
	} // end get_template

} // end class
