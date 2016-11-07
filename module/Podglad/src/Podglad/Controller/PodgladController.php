<?php

namespace Podglad\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class PodgladController extends AbstractActionController {


    public function indexAction()  {
        $this->sesja();
        return new ViewModel();
    }

    private function sesja() {
        session_start();
        if (!isset($_SESSION['id'])) {
            $_SESSION['id'] = 0;
        }
    }
    
    public function baza()
    {
        mysql_connect("localhost", "root", "root");
        mysql_select_db("extranet2");
        mysql_query("SET NAMES 'utf8'");
    }


}
