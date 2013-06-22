<?php

/**
 * Class TemplateHelpers
 */
class TemplateHelpers extends Extension
{
    /**
     * @return bool
     */
    public function isDev()
    {
        return Director::isDev();
    }
    /**
     * @return bool
     */
    public function isTest()
    {
        return Director::isTest();
    }
    /**
     * @return bool
     */
    public function isLive()
    {
        return Director::isLive();
    }
    /**
     * @param bool $includeTitle
     * @return string
     */
    public function MetaTags($includeTitle = true)
    {
        $tags = '';

        if ($includeTitle === true || $includeTitle == 'true') {
            $tags .= '<title>' . Convert::raw2xml(
                    ($this->owner->MetaTitle) ? $this->owner->MetaTitle : $this->owner->Title
                ) . '</title>' . PHP_EOL;
        }

        $tags .= '<meta charset=\'' . ContentNegotiator::get_encoding() . '\' />';

        if ($this->owner->MetaKeywords) {
            $tags .= '<meta name=\'keywords\' content=\'' . Convert::raw2att(
                    $this->owner->MetaKeywords
                ) . '\' />' . PHP_EOL;
        }

        if ($this->owner->MetaDescription) {
            $tags .= '<meta name=\'description\' content=\'' . Convert::raw2att(
                    $this->owner->MetaDescription
                ) . '\' />' . PHP_EOL;
        }

        if ($this->owner->ExtraMeta) {
            $tags .= $this->owner->ExtraMeta . PHP_EOL;
        }

        return $tags;
    }
    /**
     * @param string $scriptPath
     * @return string
     */
    public function addInlineScript($scriptPath = '')
    {
        $script = BASE_PATH . '/themes/' . Config::inst()->get('SSViewer', 'theme') . '/' . $scriptPath;
        if (!file_exists($script)) {
            return false;
        }

        return file_get_contents($script);
    }
}