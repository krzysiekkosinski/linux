<?php
 
namespace Zawodnik\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zawodnik\Model\Zawodnik;





class ZawodnikController extends AbstractActionController {

    
    protected $zawodnikTable;

    
    public function listaAction() {
        $this->sesja();
        //$request = $this->getRequest();
        $zawodnicy = $this->Tabela()->wszystko(null);

        return new ViewModel(array(
            'zawodnicy' => $zawodnicy,
            'xxx' => $zawodnicy->Count()));
    }
     
        public function dodajAction() {
        $this->sesja();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if (empty($_POST['Imie_zawodnika']) || empty($_POST['Nazwisko_zawodnika'])||empty($_POST['Data_ur'])) 
                {
                echo '<div class="alert alert-danger">Nie podałeś danych</div>';
                return new ViewModel();
            } 
            $czy_jest_zawodnik = $this->Tabela()->wszystko(array('z_imie' => $_POST['Imie_zawodnika'],'z_nazwisko' => $_POST['Nazwisko_zawodnika'],'z_data_ur' => $_POST['Data_ur']));
        $zlicz = $czy_jest_zawodnik->count();
        if ($zlicz > 0) {
                echo '<div class="alert alert-danger">Podany zawodnik już jest w bazie</div>';
                return new ViewModel();
            } else {
                $data = array(
                    'id_zawodnik' => "",
                    'z_imie' => addslashes(htmlspecialchars($_POST['Imie_zawodnika'])),
                    'z_nazwisko' => addslashes(htmlspecialchars($_POST['Nazwisko_zawodnika'])),
                    'z_data_ur' => addslashes(htmlspecialchars($_POST['Data_ur'])),
                    'id_zespol' => '1',
                );
                $zawodnik = new Zawodnik();
                $zawodnik->exchangeArray($data);
                $this->Tabela()->dodaj($zawodnik);
                return $this->redirect()->toRoute('zawodnik');
            }
        }
        return new ViewModel();
    }
    
    public function edytujAction() {
        $this->sesja();

        $id = $this->params('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('zawodnik');
        }
        $id_array = explode(',', $id);

        foreach ($id_array as $id) {

            $request = $this->getRequest();

            if (!$request->isPost()) {
                $zawodnicy = $this->Tabela()->wszystko(array('id_zawodnik' => $id));

                if ($zawodnicy->Count() == 0) {
                    return $this->redirect()->toRoute('zawodnik');
                }
                $edytuj_zawodnika = new Zawodnik();

                foreach ($zawodnicy as $zawodnik) {
                    $edytuj_zawodnika->exchangeArray(
                            array(
                                'id_zawodnik' => $zawodnik->id_zawodnik,
                                'z_imie' => $zawodnik->z_imie,
                                'z_nazwisko' => $zawodnik->z_nazwisko,
                                'z_data_ur' => $zawodnik->z_data_ur,
                                'id_zespol' => $zawodnik->id_zespol,
                            )
                    );
                }
                return new ViewModel(array('zawodnik' => $edytuj_zawodnika,));
            } else {
                $data = array(
                    'id_zawodnik' => "",
                    'z_imie' => addslashes(htmlspecialchars($_POST['Imie_zawodnika'])),
                    'z_nazwisko' => addslashes(htmlspecialchars($_POST['Nazwisko_zawodnika'])),
                    'z_data_ur' => addslashes(htmlspecialchars($_POST['Data_ur'])),
                    'id_zespol' => '1',
                );
                if (!empty($_POST['Imie_zawodnika']) && !empty($_POST['Nazwisko_zawodnika'])&& !empty($_POST['Data_ur'])) {
                        $zawodnik = new Zawodnik();
                        $zawodnik->exchangeArray($data);
                        $this->Tabela()->edytuj($zawodnik, $id);
                        return $this->redirect()->toRoute('zawodnik');
                    }
                }
            }
        
        return new ViewModel();
    }
    
     public function usunAction() {
        
        $id = $this->params('id', 0);

        $id_array = explode(',', $id);

        foreach ($id_array as $id) {
            $zawodnicy = $this->Tabela()->wszystko(array('id_zawodnik' => $id));

            $this->Tabela()->usun($id);

        }
        return $this->redirect()->toRoute('zawodnik');
    }
    
    
    public function Tabela() {
        if (!$this->ZawodnikTable) {
            $sm = $this->getServiceLocator();
            $this->ZawodnikTable = $sm->get('Zawodnik\Model\ZawodnikTable');
        }

        return $this->ZawodnikTable;
    }
    

    private function sesja() {
        session_start();
        if (!isset($_SESSION['id'])) {
            $_SESSION['id'] = 0;
        }
    }
    


}
