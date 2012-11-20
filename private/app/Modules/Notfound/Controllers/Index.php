<?php

namespace App\Modules\Notfound\Controllers;

use Sys\Controller\BaseController as Controller;

class Index extends Controller {

    protected $_message;

    public function beforeCall() {
        $this->_message = $this->getSession()->getVar('_404', 'message');
        if ($this->_message) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        }
    }

    public function indexAction() {
        $this->view['message'] = $this->_message;
        $this->render();
    }

    public function afterCall() {
        $this->getSession()->clear('_404', 'message');
    }

}