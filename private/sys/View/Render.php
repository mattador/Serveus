<?php

namespace Sys\View;

/**
 * View rendering mechanism
 *
 * @author Matthew Cooper <matthew.cooper@magneticus.org>
 */
class Render {

    public $layout;
    public $content = '';
    private $_assets = array();

    /**
     * Renders partial view inside of a layout
     * 
     * @param string $template
     * @param array $vars
     */
    public function load($template, $vars) {
        foreach ($vars as $key => $value) {
            $this->$key = $value;
        }
        foreach ($this->_assets as $key => $value) {
            $this->$key = $value;
        }
        ob_start();
        include $template;
        $this->content = ob_get_contents();
        ob_end_clean();
        ob_start();
        include $this->layout;
        ob_end_flush();
    }

    /**
     * Sets main template plus HTML assets
     * 
     * @param array $html
     * @return \Sys\View\Render
     * @throws Exception
     */
    public function setLayout($html) {
        $layout = APP . '/Layouts/' . $html['layout'];
        if (!is_file($layout)) {
            throw new Exception('Layout ' . $html['layout'] . ' does not exist');
        }
        $this->layout = $layout;
        unset($html['layout']);
        $this->_assets = array_merge($html, $this->_assets);
        return $this;
    }

}