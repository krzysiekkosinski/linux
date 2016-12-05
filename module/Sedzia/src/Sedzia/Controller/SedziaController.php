<?php
 
namespace Sedzia\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Uzytkownik;




class SedziaController extends AbstractActionController {

    
    protected $uzytkownikTable;

    public function listaAction() {
        $this->sesja();
            $sedziowie = $this->Tabela()->wszystko(array('u_funkcja' =>'sedzia'));
        
        
        return new ViewModel(array(
            'sedziowie' => $sedziowie,
            'xxx' => $sedziowie->Count()));
    }
    
    
    
    
    public function Tabela() {
        if (!$this->UzytkownikTable) {
            $sm = $this->getServiceLocator();
            $this->UzytkownikTable = $sm->get('Application\Model\UzytkownikTable');
        }

        return $this->UzytkownikTable;
    }

    private function sesja() {
        session_start();
        if (!isset($_SESSION['id'])) {
            $_SESSION['id'] = 0;
        }
    }
    


}
