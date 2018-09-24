# Page Template Dashboard

[![License](https://img.shields.io/badge/license-GPL--2.0%2B-red.svg)](https://github.com/pressware/easier-excerpts/blob/master/license.txt)

An easy way to see which templates your pages are using without having to view the page editor.

## Description

Page Template Dashboard is a simple plugin that let's you easily survey which template each page is using without
having to load the page editor.

If no template is assigned, then the 'Default' template will be rendered; otherwise, the user-friendly name (rather than
the file name) will be displayed.

Finally, the plugin will properly handle the case when a page has a template assigned to it from a previous theme that
does not exist in the current theme

The plugin is also fully localized for translation.

For more information or to follow the project, check out the [project page](https://tommcfarlin.com/view-page-templates/).

## Installation

### Using The WordPress Dashboard

1. Navigate to the 'Add New' Plugin Dashboard
2. Select `page-template-dashboard.zip` from your computer
3. Upload
4. Activate the plugin on the WordPress Plugin Dashboard

### Using FTP

1. Extract `page-template-dashboard.zip` to your computer
2. Upload the `page-template-dashboard` directory to your `wp-content/plugins` directory
3. Activate the plugin on the WordPress Plugins dashboard

### Using Composer 

1. `composer require wpackagist-plugin/page-template-dashboard`

## Hooks

Page Template Dashboard offers hooks to customize the plugin. You can add your hooks into your theme `functions.php`.

__page_template_dashboard_post_types__

Add or adjust which custom post types show the template column in the admin.

```
add_filter( 'page_template_dashboard_post_types', 'show_template_for_custom_post_type');

function show_template_for_custom_post_type ($post_types) {
    $post_types[] = 'my_post_type';
    return $post_types;
});
```

## Notes

Page Template Dashboard...

* Follows the [WordPress Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards)
* Uses native WordPress API's (specifically the [Plugin API](http://codex.wordpress.org/Plugin_API))
* Respects WordPress bloggers everywhere :)