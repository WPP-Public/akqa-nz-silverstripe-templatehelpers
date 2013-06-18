<?php

class TemplateHelpers extends Extension
{
    public function isDev()
    {
        return Director::isDev();
    }

    public function isTest()
    {
        return Director::isTest();
    }

    public function isLive()
    {
        return Director::isLive();
    }

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

    public function addInlineScript($scriptPath = '')
    {
        $script = THEMES_PATH . DIRECTORY_SEPARATOR . SSViewer::current_theme() . $scriptPath;
        if (!file_exists($script)) {
            return '';
        }

        return file_get_contents($script);
    }
}