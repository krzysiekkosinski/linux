<?php

namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
class IndexController extends AbstractActionController
{
    
     public function indexAction()
    {
 
         $this->sesja();
         return $this->redirect()->toRoute('/login');
 
    }
    
    public function loginAction(){
        $this->sesja();
        $this->baza();
    if (!empty($_POST['login']) && !empty($_POST['pwd'])){
        $passwords=$_POST['pwd'];
        $query=(mysql_query("select id_dzialacz,d_imie,d_nazwisko,d_login,d_haslo  
        from dzialacz where 
        d_login='".htmlspecialchars($_POST['login'])."' AND d_haslo='$passwords'"));
        $fetch = mysql_fetch_assoc($query);
        $_SESSION['id'] = $fetch['id_dzialacz'];
        if ($_SESSION['id']!=0){
            $_SESSION['name'] = $fetch['d_login'];
            return $this->redirect()->toUrl('zarzadzanie');
            }}
                else 
                    return $this->redirect()->toRoute('home');      
        }
        
        public function registerAction(){
        $this->sesja();
        $this->baza();
        return $this->redirect()->toRoute('home');      
        }
     
                
   public function logoutAction()
    {
       //$this->sesja();
        session_destroy();
        return $this->redirect()->toRoute('home');
    }
    
    private function sesja()
    {
        session_start();
        if (!isset($_SESSION['id'])) {$_SESSION['id'] = 0;}
    }
    public function baza()
    {
        mysql_connect("localhost", "root", "root");
mysql_select_db("extranet2");
mysql_query("SET NAMES 'utf8'");
    }
}