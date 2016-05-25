<?php
class Application_Model_GenreMapper
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

    public function ajouterGenre(Application_Model_Genre $genre)
    {
        $data = array(
            'genre' => $genre->getGenre(),
        );
        if (null === ($id = $genre->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function modifierGenre($id, $genre)
    {
        $data = array(
            'genre' => $genre,
        );
        $this->getDbTable()->update($data, array('id = ?' => $id));
    }

    public function obtenirGenre($id)
    {
        $row = $this->_db->fetchRow('SELECT * FROM '.$this->getDbTable()->getName().' WHERE `id` = '.$id.' ');
        if($row){
            $genre = new Application_Model_Genre();
            $genre->setId($row['id']);
            $genre->setGenre($row['genre']);

            return $genre;
        }
        else {
            return 0;
        }
    }

    public function supprimerGenre($id)
    {
        $this->getDbTable()->delete('id =' . (int)$id);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Genre();
            $entry->setId($row->id)
                  ->setGenre($row->genre);
            $entries[] = $entry;
        }
        return $entries;
    }
}
