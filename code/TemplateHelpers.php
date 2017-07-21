<?php

namespace Heyday\TemplateHelpers;

use SilverStripe\View\TemplateGlobalProvider;
use SilverStripe\Control\Director;
use SilverStripe\View\SSViewer;
use SilverStripe\Core\Config\Config;


/**
 * Class TemplateHelpers
 * @package Heyday\TemplateHelpers
 */
class TemplateHelpers implements TemplateGlobalProvider
{
    private static $casting = array(
        'MetaTags' => 'HTMLText',
        'addInlineScript' => 'HTMLText'
    );

    /**
     * @return array
     */
    public static function get_template_global_variables()
    {
        return array(
            'isDev',
            'isTest',
            'isLive',
            'addInlineScript',
            'ThemeDir',
            'ImagePath'
        );
    }

    /**
     * @return bool
     */
    public static function isDev()
    {
        return Director::isDev();
    }

    /**
     * @return bool
     */
    public static function isTest()
    {
        return Director::isTest();
    }
    /**
     * @return bool
     */
    public static function isLive()
    {
        return Director::isLive();
    }

    /**
     * @param string $scriptPath
     * @return string
     */
    public static function addInlineScript($scriptPath = '')
    {
        $script = BASE_PATH . '/themes/' . self::ThemeDir() . '/' . $scriptPath;
        if (!file_exists($script)) {
            return false;
        }

        return file_get_contents($script);
    }

    /**
     * @return mixed
     */
    public static function ThemeDir()
    {
        $themes = SSViewer::get_themes();
        return $themes[0];
    }

    /**
     * Get an image path for the current environment
     *
     * @param string $imageURL - path to append to the path
     * @return string
     */
    public static function ImagePath($imageURL)
    {
        $config = Config::forClass('Heyday\TemplateHelpers\TemplateHelpers');

        if (Director::isDev()) {
            $imagesPath = $config->get('dev_images');
        } else {
            $imagesPath = $config->get('prod_images');
        }

        return self::joinPaths(array(self::ThemeDir(), $imagesPath, $imageURL));
    }

    /**
     * Join one or more path components
     *
     * @param array $paths
     * @return string
     */
    public static function joinPaths(array $paths)
    {
        return preg_replace('#/+#','/', join('/', $paths));
    }
}
