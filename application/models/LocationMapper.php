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
        if (null === ($idlocation = $location->getId())) {
            unset($data['idlocation']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('idlocation = ?' => $idlocation));
        }
    }

    public function saisirRetourLocation($idlocation, $dateRetour)
    {
        $data = array(
            'date_retour'     =>  $dateRetour,
        );
        $this->getDbTable()->update($data, array('idlocation = ?' => $idlocation));
    }

    public function obtenirAllSorties()
    {
        $sql = "SELECT 	    l.idlocation AS idLocation
                    	    , p.prenom AS prenomPersonne
                            , p.nom AS nomPersonne
                            , p.numero_adherent AS numeroAdherent
                            , f.nom AS nomFilm
                            , l.date_location AS dateLocation
                FROM        location l
                INNER JOIN  media m     ON m.id = l.media_id
                INNER JOIN  film f      ON f.id = m.Film_idFilm
                INNER JOIN  personne p  ON p.id = l.Personne_id
                WHERE       ISNULL(date_retour)
                ORDER BY l.date_location";

        $recup = $this->_db->fetchAll($sql);

        $tab = array();

        foreach ($recup as $row) {
            $location = new Application_Model_Location();
            $location   ->setId($row['idLocation'])
                        ->setDateLocation($row['dateLocation']);
            $tab[] = $location;

            $personne = new Application_Model_Personne();
            $personne   ->setPrenom($row['prenomPersonne'])
                        ->setNom($row['nomPersonne'])
                        ->setNumeroAdherent($row['numeroAdherent']);
            $tab[] = $personne;

            $film     = new Application_Model_Film();
            $film       ->setNom($row['nomFilm']);
            $tab[] = $film;
        }
        return $tab;
    }
}
