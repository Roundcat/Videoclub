<?php

class Application_Model_ActeurRealisateurMapper
{
    protected $_dbTable;
    protected $_table;
    protected $_db;

        public function __construct() {
           $this->_table = "acteur_realisateur";
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
            $this->setDbTable('Application_Model_DbTable_ActeurRealisateur');
        }
        return $this->_dbTable;
    }

    public function ajouterActeurRealisateur(Application_Model_ActeurRealisateur $acteurRealisateur)
    {
        $data = array(
            'prenom'    => $acteurRealisateur->getPrenom(),
            'nom'       => $acteurRealisateur->getNom(),
        );
        if (null === ($id = $acteurRealisateur->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function modifierActeurRealisateur($id, $prenom, $nom)
    {
        $data = array(
            'prenom'            =>  $prenom,
            'nom'               =>  $nom,
        );
        $this->getDbTable()->update($data, array('id = ?' => $id));
    }

    public function obtenirActeurRealisateur($id)
    {
        $row = $this->_db->fetchRow('SELECT * FROM '.$this->getDbTable()->getName().' WHERE `id` = '.$id.' ');
        if($row){
            $acteurRealisateur = new Application_Model_ActeurRealisateur();
            $acteurRealisateur->setId($row['id']);
            $acteurRealisateur->setPrenom($row['prenom']);
            $acteurRealisateur->setNom($row['nom']);

            return $acteurRealisateur;
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
            $entry = new Application_Model_ActeurRealisateur();
            $entry->setId($row->id)
                  ->setPrenom($row->prenom)
                  ->setNom($row->nom);
            $entries[] = $entry;
        }
        return $entries;
    }

}
