# SilverStripe template helpers

A library with common functionality used by SilverStripe template developers.

# Installation (with composer)

    $ composer require heyday/silverstripe-templatehelpers

# Usage

Once installed, the following functions are available in any .ss template:

* **`$isDev`** - If the site is running in a development environment
* **`$isTest`** - If the site is running in a test environment
* **`$isLive`** - If the site is running in a production environment
* **`$ImagePath('my-image.png')`** - Build an image path based on config for the current environment
* **`$addInlineScript('/path/in/theme/directory/file.js')`** - include a javascript file verbatim in the template (note that `<script>` tags aren't generated automatically, so you'll need to add those around this call).

## `$ImagePath` config

The image path helper defaults to `themes/[theme]/images/`. The path within the theme directory can be configured in your project's YAML config:

```yaml
TemplateHelpers:
  dev_images: source/images
  prod_images: production/images
```
