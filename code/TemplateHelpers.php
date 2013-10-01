<?php

/**
 * Class TemplateHelpers
 */
class TemplateHelpers implements TemplateGlobalProvider
{
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
            'MetaTags',
            'ThemeDir'
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
     * @param bool     $includeTitle
     * @param SiteTree $page
     * @return string
     */
    public static function MetaTags($includeTitle = true, SiteTree $page = null)
    {
        $tags = '';

        if ($page && ($includeTitle === true || $includeTitle == 'true')) {
            $tags .= '<title>' . Convert::raw2xml(
                    ($page->MetaTitle) ? $page->MetaTitle : $page->Title
                ) . '</title>' . PHP_EOL;
        }

        $tags .= '<meta charset=\'' . Config::inst()->get('ContentNegotiator', 'encoding') . '\' />';
        
        if ($page instanceof SiteTree) {
    
            if ($page->MetaDescription) {
                $tags .= '<meta name=\'description\' content=\'' . Convert::raw2att(
                        $page->MetaDescription
                    ) . '\' />' . PHP_EOL;
            }
    
            if ($page->ExtraMeta) {
                $tags .= $page->ExtraMeta . PHP_EOL;
            }

        }

        return $tags;
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
        return '/themes/' . Config::inst()->get('SSViewer', 'theme');
    }
}