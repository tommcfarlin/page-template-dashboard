# Change Log for Page Template Dashboard

As of 1.8.0, all notable changes to this project will be documented
in this file. This project adheres to [Semantic Versioning](http://semver.org/).

## 1.8.0

* Verifies WordPress 4.9 compatibility.

### Changed

* Fix bug : Could not find a template name in a parent theme.
* Fix bug : Stop using get_file_description function that was not always working (use another way).

## 1.7.0

### Added

* Verifies WordPress 4.7 compatibility.
* Adds Composer support for PHP Unit and PHP CodeSniffer.
* Adds CHANGELOG.md for users on GitHub.

### Changed

* Updates screenshot for the most recent version of WordPress.
* Updates code to the WordPress Coding Standards.
* Removes the implementation of the Singleton Pattern.
* Removes the locale property in place of actual strings for i18n.

### Removed

## 1.6.0

* Verifying WordPress 4.2.1 compatibility

## 1.5.0

* Verifying WordPress 4.1 compatibility

## 1.4.0

* Verifying WordPress 3.9 compatibility

## 1.3.0

* Verifying WordPress 3.8 compatibility

## 1.2.0

* Updating the version number
* Fixed a debug message
* Improved localization
* Improved the code comments
* Moved the plugin's class into its own file
* Implemented the singleton pattern
* Added LICENSE.txt

## 1.1

* Adding Finnish translation (thanks to <a href="http://twitter.com/SipuliSopuli/">Timi Wahalahti</a>)
* Adding support for child themes (thanks to <a href="http://twitter.com/MaorH">Maor Chasen's</a> suggestion)
* Using `get_page_template_slug` instead of reading Post Meta Data (thanks to <a href="http://twitter.com/MaorH/">Maor Chasen's</a> suggestion)
* Updating the screenshot

## 1.0.1

* Minor update to the screenshot and the Development Information

## 1.0

* Initial release
