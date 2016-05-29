<?php

class Application_Model_PersonneMapper
{
    protected $_dbTable;
    protected $_table;
    protected $_db;

        public function __construct() {
           $this->_table = "genre";
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
            $this->setDbTable('Application_Model_DbTable_Genre');
        }
        return $this->_dbTable;
    }

    public function obtenirAllClients($id)
    {
        $row = $this->_db->fetchAll('SELECT * FROM '.$this->getDbTable()->getName().' WHERE `id` = '.$id.' AND `estEmploye` = 0 ;');
        if($row){
            $client = new Application_Model_Personne();
            $client->setId($row['id']);
            $client->setPrenom($row['prenom']);

            return $client;
        }
        else {
            return 0;
        }
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Personne();
            $entry->setId($row->id)
                  ->setPrenom($row->prenom)
                  ->setNom($row->nom);
            $entries[] = $entry;
        }
        return $entries;
    }
}
