<?php

class Application_Model_FilmMapper
{
    protected $_dbTable;
    protected $_table;
    protected $_db;

        public function __construct() {
           $this->_table = "film";
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
            $this->setDbTable('Application_Model_DbTable_Personne');
        }
        return $this->_dbTable;
    }

    public function obtenirFilm($id)
    {
        $row = $this->_db->fetchRow('SELECT * FROM '.$this->getDbTable()->getName().' WHERE `id` = '.$id.' ');
        if($row){
            $film = new Application_Model_Film();
            $film->setId($row['id']);
            $film->setNom($row['nom']);
            $film->setResume($row['resume']);
            $film->setDateFilm($row['date_film']);
            $film->setRealisateur($row['realisateur_id']);
            $film->setActeur1($row['acteur1']);
            $film->setActeur2($row['acteur2']);
            $film->setActeur3($row['acteur3']);
            $film->setDateCreation($row['date_creation']);
            $film->setGenre($row['id_genre']);

            return $film;
        }
        else {
            return 0;
        }
    }
}
