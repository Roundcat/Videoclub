<?php
class Application_Model_GenreMapper
{
    protected $_dbTable;
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
    public function save(Application_Model_Genre $genre)
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
    public function find($id, Application_Model_Genre $genre)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $genre->setId($row->id)
              ->setGenre($row->genre);
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
