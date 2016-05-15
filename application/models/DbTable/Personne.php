<?php

class Application_Model_DbTable_Personne extends Zend_Db_Table_Abstract
{
    protected $_name = 'personne';

    public function obtenirPersonne($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterPersonne($nom, $prenom, $password, $courriel, $adresse1, $adresse2, $codePostal, $ville, $estEmploye)
    {
        $data = array(
            'nom'         =>  $nom,
            'prenom'      =>  $prenom,
            'motDePasse'  =>  $password,
            'courriel'    =>  $courriel,
            'adresse1'    =>  $adresse1,
            'adresse2'    =>  $adresse2,
            'code_postal'  =>  $codePostal,
            'ville'       =>  $ville,
            'esEmploye'   =>  $estEmploye,
        );
        $this->insert($data);
    }

    public function modifierPersonne($id, $nom, $prenom, $password, $courriel, $adresse1, $adresse2, $codePostal, $ville, $estEmploye)
    {
        $data = array(
            'nom'         =>  $nom,
            'prenom'      =>  $prenom,
            'motDePasse'  =>  $password,
            'courriel'    =>  $courriel,
            'adresse1'    =>  $adresse1,
            'adresse2'    =>  $adresse2,
            'code_postal'  =>  $codePostal,
            'ville'       =>  $ville,
            'esEmploye'   =>  $estEmploye,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function desactivePersonne($id, $desactive)
    {
      $desactive = 1;
      $data = array(
          'desactive'     =>  $desactive,
      );
      $this->update($data, 'id = '. (int)$id);
    }
}
