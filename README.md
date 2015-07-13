Page Template Dashboard
---
**Contributors:** tommcfarlin  
**Donate link:** https://tommcfarlin.com/projects/page-template-dashboard/  
**Tags:** page, templates  
**Requires at least:** 3.4  
**Tested up to:** 4.2.1  
**Stable tag:** 1.6.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

An easy way to see which templates your pages are using without having to view the page editor.

## Description

Page Template Dashboard is a simple plugin that let's you easily survey which template each page is using without
having to load the page editor.

If no template is assigned, then the 'Default' template will be rendered; otherwise, the user-friendly name (rather than
the file name) will be displayed.

Finally, the plugin will properly handle the case when a page has a template assigned to it from a previous theme that
does not exist in the current theme

The plugin is also fully localized for translation.

For more information or to follow the project, check out the [project page](http://tommcfarlin.com/projects/page-template-dashboard/).

## Installation

### Using The WordPress Dashboard

1. Navigate to the 'Add New' Plugin Dashboard
1. Select `page-template-dashboard.zip` from your computer
1. Upload
1. Activate the plugin on the WordPress Plugin Dashboard

### Using FTP

1. Extract `page-template-dashboard.zip` to your computer
1. Upload the `page-template-dashboard` directory to your `wp-content/plugins` directory
1. Activate the plugin on the WordPress Plugins dashboard

## Screenshots

1. The Pages Dashboard with the plugin activated.
![The Pages Dashboard with the plugin activated](https://raw.githubusercontent.com/tommcfarlin/page-template-dashboard/master/screenshot-1.png)

## Changelog

### 1.6.0

* Verifying WordPress 4.2.1 compatibility

### 1.5.0
* Verifying WordPress 4.1 compatibility

### 1.4.0

* Verifying WordPress 3.9 compatibility

### 1.3.0

* Verifying WordPress 3.8 compatibility

### 1.2.0

* Updating the version number
* Fixed a debug message
* Improved localization
* Improved the code comments
* Moved the plugin's class into its own file
* Implemented the singleton pattern
* Added LICENSE.txt

### 1.1
* Adding Finnish translation (thanks to <a href="http://twitter.com/SipuliSopuli/">Timi Wahalahti</a>)
* Adding support for child themes (thanks to <a href="http://twitter.com/MaorH">Maor Chasen's</a> suggestion)
* Using `get_page_template_slug` instead of reading Post Meta Data (thanks to <a href="http://twitter.com/MaorH/">Maor Chasen's</a> suggestion)
* Updating the screenshot

### 1.0.1
* Minor update to the screenshot and the Development Information

### 1.0
* Initial release

## Development Information

Page Template Dashboard...

* [WordPress Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards)
* Native WordPress API's (specifically the [Plugin API](http://codex.wordpress.org/Plugin_API))
* Respect for WordPress bloggers everywhere :)
