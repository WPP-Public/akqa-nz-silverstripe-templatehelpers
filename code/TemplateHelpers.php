<?php

/**
 * Class TemplateHelpers
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
        $script = BASE_PATH . '/themes/' . Config::inst()->get('SSViewer', 'theme') . '/' . $scriptPath;
        if (!file_exists($script)) {
            return false;
        }

        return file_get_contents($script);
    }

    public static function ThemeDir()
    {
        return 'themes/' . Config::inst()->get('SSViewer', 'theme');
    }

    public static function ImagePath($imageURL)
    {
        $imagesPath = '/themes/' . Config::inst()->get('SSViewer', 'theme');
        $dev_path = Config::inst()->forClass('TemplateHelpers')->get('dev_images');
        $prod_path = Config::inst()->forClass('TemplateHelpers')->get('prod_images');

        if (Director::isDev()) {
            $imagesPath = $imagesPath . $dev_path . $imageURL;
        } else {
            $imagesPath = $imagesPath . $prod_path . $imageURL;
        }

        return $imagesPath;
    }
}
