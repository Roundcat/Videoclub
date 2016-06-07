<?php

class Application_Model_DbTable_Media extends Zend_Db_Table_Abstract
{

    protected $_name = 'media';

    public function getName()
    {
        return $this->_name;
    }

}
