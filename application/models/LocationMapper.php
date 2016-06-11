<?php

class Application_Model_LocationMapper
{
    protected $_dbTable;
    protected $_table;
    protected $_db;

        public function __construct() {
           $this->_table = "location";
           $this->_db = Zend_Registry::get('db');
           $this->_db->query("SET NAMES UTF8");
        }

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception ('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Location');
        }
        return $this->_dbTable;
    }

    public function saisirSortieLocation(Application_Model_Location $location)
    {
        $data = array(
            'Personne_id'       =>  $location->getPersonneId(),
            'media_id'          =>  $location->getMediaId(),
            'date_location'     =>  $location->getDateLocation(),
        );
        if (null === ($id = $film->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
}
