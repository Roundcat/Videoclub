<?php

class Application_Model_DbTable_Film extends Zend_Db_Table_Abstract
{

    protected $_name = 'film';

    public function getName()
    {
        return $this->_name;
    }

}
