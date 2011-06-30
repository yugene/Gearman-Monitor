<?php

/**
 * Simple view class
 */
class GA_View
{
    /**
     * Directory with page templates
     *
     * @var string
     */
    protected $_templateDir = '';

    /**
     * Variables assigned
     *
     * @var array
     */
    protected $_templateVars = array();

    /**
     * Magic method to access assigned variables
     *
     * @param string $name Variable name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->_templateVars[$name]))
        {
            return $this->_templateVars[$name];
        }
        else
        {
            return null;
        }
    }

    /**
     * Magic method to set assigned variables
     *
     * @param string $name Variable name
     * @param mixed $value Variable value
     */
    public function __set($name, $value)
    {
        $this->assign($name, $value);
    }

    /**
     * Return page templates directory
     *
     * @return string
     */
    public function getTemplateDir()
    {
        return $this->_templateDir;
    }

    /**
     * Set page templates directory
     *
     * @param string $templateDir Templates directory
     */
    public function setTemplateDir($templateDir)
    {
        $templateDir = rtrim($templateDir, '\/') . '/';

        $this->_templateDir = $templateDir;
    }

    /**
     * Assign template variable
     *
     * @param string $name Variable name
     * @param mixed $value Variable value
     */
    public function assign($name, $value)
    {
        $this->_templateVars[$name] = $value;
    }

    /**
     * Render and display template
     *
     * @param string $templateName Template file name
     */
    public function display($templateName)
    {
        $template = $this->_templateDir . $templateName;

        if (file_exists($template))
        {
            include($template);
        }
    }

    /**
     * Display table column title with sorting
     *
     * @param string $href Current page URI
     * @param string $title Column title
     * @param string $value Sort column value
     */
    protected function fnSortCol($href, $title, $value)
    {
        $currentSortColumn = (isset($_REQUEST['sort']) ? $_REQUEST['sort'] : '');
        $currentSortDir = (isset($_REQUEST['dir']) ? $_REQUEST['dir'] : GA_ServerList::SORT_ASC);

        $dir = GA_ServerList::SORT_ASC;
        $img = '';

        if ($value == $currentSortColumn)
        {
            if ($currentSortDir == GA_ServerList::SORT_ASC)
            {
                $dir = GA_ServerList::SORT_DESC;
                $img = '<img src="images/s_asc.png" />';
            }
            else
            {
                $img = '<img src="images/s_desc.png" />';
            }
        }

        $result = "<a href='{$href}sort={$value}&dir={$dir}' onclick='var d = window.parent.filterFrame.document; d.getElementById(\"filterSort\").value = \"{$value}\"; d.getElementById(\"filterDir\").value = \"{$dir}\"; return true;'>{$title} {$img}</a>";

        echo $result;
    }
}

?>