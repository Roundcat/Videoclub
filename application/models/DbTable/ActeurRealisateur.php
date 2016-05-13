<?php

class Application_Model_DbTable_ActeurRealisateur extends Zend_Db_Table_Abstract
{

    protected $_name = 'acteur-realisateur';

    public function obtenirActeurRealisateur($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterActeurRealisateur($nom, $prenom)
    {
        $data = array(
            'nom' => $nom,
            'prenom' => $prenom,
        );
        $this->insert($data);
    }

    public function modifierActeurRealisateur($id, $nom, $prenom)
    {
        $data = array(
            'nom' => $nom,
            'prenom' => $prenom,
        );
        $this->update($data, 'id = '. (int)$id);
    }


}
