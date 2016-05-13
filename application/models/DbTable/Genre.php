<?php

class Application_Model_DbTable_Genre extends Zend_Db_Table_Abstract
{

    protected $_name = 'genre';

    public function obtenirGenre($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Impossible de trouver l'enregistrement $id");
        }
        return $row->toArray();
    }

    public function ajouterGenre($genre)
    {
        $data = array(
            'genre' => $genre,
        );
        $this->insert($data);
    }

    public function modifierGenre($id, $genre)
    {
        $data = array(
            'genre' => $genre,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function supprimerGenre($id)
    {
        $this->delete('id =' . (int)$id);
    }

}
