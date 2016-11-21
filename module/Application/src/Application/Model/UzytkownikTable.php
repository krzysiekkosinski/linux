<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class UzytkownikTable
{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function zlicz($tablica = array())
    {
        return $this->tableGateway->select($tablica)->count();
    }
    
    public function wszystko($tablica = array()) {
        $wynik = $this->tableGateway->select($tablica);
        return $wynik;
    }
 
    public function dodaj(Uzytkownik $uzytkownik)
    {
        $data = array(
            'id_dzialacz' => $uzytkownik->id_dzialacz,
            'd_imie' => $uzytkownik->d_imie,
            'd_nazwisko' => $uzytkownik->d_nazwisko,
            'd_login' => $uzytkownik->d_login,
            'd_haslo' => $uzytkownik->d_haslo,
            'd_mail' => $uzytkownik->d_mail,
        );
        
        $this->tableGateway->insert($data);
    }
    
    public function edytuj(Uzytkownik $uzytkownik, $id_dzialacz) {
        $data = array(
            'id_dzialacz' => $uzytkownik->id_dzialacz,
            'd_imie' => $uzytkownik->d_imie,
            'd_nazwisko' => $uzytkownik->d_nazwisko,
            'd_login' => $uzytkownik->d_login,
            'd_haslo' => $uzytkownik->d_haslo,
            'd_mail' => $uzytkownik->d_mail,

        );
        

        
        $id = (int) $data['id_dzialacz'];
        if ($this->wszystko(array('id_dzialacz' => $id_dzialacz))->Count()) {
                 $this->tableGateway->update($data,array('id_dzialacz' => $id_dzialacz));
             } else {
                 throw new \Exception('Użytkownik o tym id nie istnieje');
             }
    }

    public function usun($id_dzialacz) {
        $this->tableGateway->delete(array('id_dzialacz' => (int) $id_dzialacz));
    }
}
