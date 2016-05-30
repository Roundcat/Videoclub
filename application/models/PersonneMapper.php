<?php

class Application_Model_PersonneMapper
{
    protected $_dbTable;
    protected $_table;
    protected $_db;

        public function __construct() {
           $this->_table = "personne";
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

    public function obtenirPersonne($id)
    {
        $row = $this->_db->fetchRow('SELECT * FROM '.$this->getDbTable()->getName().' WHERE `id` = '.$id.' ');
        if($row){
            $personne = new Application_Model_Personne();
            $personne->setId($row['id']);
            $personne->setNom($row['nom']);

            return $personne;
        }
        else {
            return 0;
        }
    }

    public function obtenirAllClients()
    {
        $sql = "SELECT  id
                        , prenom
                        , nom
                FROM    personne
                WHERE   estemploye = 0
                ORDER BY nom ASC, prenom ASC;";

        $recup = $this->_db->fetchAll($sql);

        $tab = array();

        foreach ($recup as $row) {
            $client = new Application_Model_Personne();
            $client ->setId($row['id'])
                    ->setPrenom($row['prenom'])
                    ->setNom($row['nom']);

            $tab[] = $client;
        }
        return $tab;
    }

    public function obtenirAllEmployes()
    {
        $sql = "SELECT  id
                        , prenom
                        , nom
                FROM    personne
                WHERE   estemploye = 1
                ORDER BY nom ASC, prenom ASC;";

        $recup = $this->_db->fetchAll($sql);

        $tab = array();

        foreach ($recup as $row) {
            $employe = new Application_Model_Personne();
            $employe ->setId($row['id'])
                    ->setPrenom($row['prenom'])
                    ->setNom($row['nom']);

            $tab[] = $employe;
        }
        return $tab;
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Personne();
            $entry->setId($row->id)
                  ->setPrenom($row->prenom)
                  ->setNom($row->nom)
                  ->setEstEmploye($row->estEmploye);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function modifierPersonne($id, $prenom, $nom, $courriel, $adresse1, $adresse2, $codePostal, $ville, $password, $estEmploye)
    {
        $data = array(
            'prenom'            =>  $prenom,
            'nom'               =>  $nom,
            'courriel'          =>  $courriel,
            'adresse1'          =>  $adresse1,
            'adresse2'          =>  $adresse2,
            'code_postal'       =>  $codePostal,
            'ville'             =>  $ville,
            'motDePasse'        =>  $password,
            'estEmploye'        =>  $estEmploye,
        );
        $this->getDbTable()->update($data, array('id = ?' => $id));
    }
}
