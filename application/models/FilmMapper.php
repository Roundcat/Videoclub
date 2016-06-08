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
            $this->setDbTable('Application_Model_DbTable_Film');
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

    public function obtenirAllFilms()
    {
        $sql = "SELECT  id
                        , nom
                        , resume
                FROM    film
                ORDER BY nom ASC;";

        $recup = $this->_db->fetchAll($sql);

        $tab = array();

        foreach ($recup as $row) {
            $film = new Application_Model_Film();
            $film ->setId($row['id'])
                    ->setNom($row['nom'])
                    ->setResume($row['resume']);

            $tab[] = $film;
        }
        return $tab;
    }

    public function ajouterFilm(Application_Model_Film $film)
    {
        $data = array(
            'nom' => $film->getNom(),
            'date_film' => $film->getDateFilm(),
            'resume' => $film->getResume(),
            'realisateur_id' => $film->getRealisateurId(),
            'date_creation' => $film->getDateCreation(),
            'acteur1' => $film->getActeur1(),
            'acteur2' => $film->getActeur2(),
            'acteur3' => $film->getActeur3(),
            'id_genre' => $film->getGenre(),
        );
        if (null === ($id = $film->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    
}
