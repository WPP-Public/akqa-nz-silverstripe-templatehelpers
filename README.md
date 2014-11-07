# SilverStripe template helpers

A library with common functionality used by SilverStripe template developers.

For a SilverStripe `2.4` compatible version see branch `0.1`.

# Installation (with composer)

    $ composer require heyday/silverstripe-templatehelpers

# Usage

Once installed, the following functions are available in any .ss template:

* **`$isDev`** - If the site is running in a development environment
* **`$isTest`** - If the site is running in a test environment
* **`$isLive`** - If the site is running in a production environment
* **`$addInlineScript('/path/in/theme/directory/file.js')`** - include a javascript file verbatim in the template (note that `<script>` tags aren't generated automatically, so you'll need to add those around this call).
