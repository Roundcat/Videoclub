<?php

class Application_Model_DbTable_Location extends Zend_Db_Table_Abstract
{

    protected $_name = 'location';

    public function getName()
    {
        return $this->_name;
    }
}
