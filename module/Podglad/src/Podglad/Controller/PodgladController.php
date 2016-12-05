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
    


}
