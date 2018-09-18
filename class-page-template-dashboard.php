<?php
/**
 * Page Template Dashboard
 *
 * @package   PTD
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 * @license   GPL-2.0+
 * @link      http://tommcfarlin.com/page-template-dashboard/
 * @copyright 2013 - 2018 Tom McFarlin
 */

/**
 * Page Template Dashboard adds a column to your 'All Pages' dashboard to see which templates
 * your pages are using.
 *
 * @package   PTD
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 */
class Page_Template_Dashboard {

	/**
	 * Registers all hooks necessary for plugin functionality.
	 */
	public function init() {

		add_action(
			'init',
			array( $this, 'plugin_textdomain' )
		);

	    add_filter(
			'manage_edit-page_columns',
			array( $this, 'add_template_column' )
		);

	    add_action(
			'manage_page_posts_custom_column',
			array( $this, 'add_template_data' )
		);
	}

	/**
	 * Loads the plugin text domain for translation.
	 */
	public function plugin_textdomain() {

		load_plugin_textdomain(
			'page-template-dashboard',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/lang'
		);
	}

	/**
	 * Introduces a new column to the 'Page' dashboard that will be used to render the page template
	 * for the given page.
	 *
	 * @param array	$page_columns The array of columns rendering page meta data.
	 *
	 * @return array $page_columns The update array of page columns.
	 */
	public function add_template_column( $page_columns ) {

		$page_columns['template'] = __( 'Page Template', 'page-template-dashboard-locale' );
		return $page_columns;
	}

	/**
	 * Renders the name of the template applied to the current page. Will use 'Default' if no
	 * template is used, but will use the friendly name of the template if one is applied.
	 *
	 * @param   string $column_name The name of the column being rendered.
	 */
	public function add_template_data( $column_name ) {

		// If we're not looking at the 'Template' column, then we're done.
		if ( 'template' !== $column_name ) {
			return;
		}

		self::get_template_name();
	}

	public static function get_template_name() {
		// Grab a reference to the post that's currently being rendered.
		global $post;

		// First, the get name of the template.
		$template_name = get_page_template_slug( $post->ID );

		// Locate template from the child or parent theme.
		$template = locate_template( $template_name, false, false );
		if ( ! empty( $template ) ) {
			// Get template name in the header comment of the file
			$template_data = implode( '', file( $template ) );
			if ( preg_match( '|Template Name:(.*)$|mi', $template_data, $name ) ) {
				$template_name = _cleanup_header_comment( $name[1] );
			}
		} else {
			$template_name = __( 'Default', 'page-template-dashboard-locale' );
		}

		// Finally, render the template name.
		echo esc_html( $template_name );
	}
}
