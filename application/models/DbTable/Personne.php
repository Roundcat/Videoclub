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

    
}
