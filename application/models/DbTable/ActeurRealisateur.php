<?php

class Application_Model_DbTable_ActeurRealisateur extends Zend_Db_Table_Abstract
{

    protected $_name = 'acteur_realisateur';

    public function getName()
    {
        return $this->_name;
    }

}
