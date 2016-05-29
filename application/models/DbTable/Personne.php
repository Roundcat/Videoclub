<?php

class Application_Model_DbTable_Personne extends Zend_Db_Table_Abstract
{

    // Déclaration du nom de la table
    protected $_name = 'personne';

    public function getName()
    {
        return $this->_name;
    }

}
