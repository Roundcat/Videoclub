<?php

/**
 * C'est la classe DbTable pour la table genre
 */
class Application_Model_DbTable_Genre extends Zend_Db_Table_Abstract
{

    // Déclaration du nom de la table
    protected $_name = 'genre';

    public function getName()
    {
        return $this->_name;
    }

}
