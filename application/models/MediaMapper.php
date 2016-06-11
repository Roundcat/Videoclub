<?php

class Application_Model_MediaMapper
{
    protected $_dbTable;
    protected $_table;
    protected $_db;

        public function __construct() {
           $this->_table = "media";
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
            $this->setDbTable('Application_Model_DbTable_Media');
        }
        return $this->_dbTable;
    }

    public function ajouterMediaDVD($id)
    {
        $data = array(
            'type_media'        =>  'DVD',
            'Film_idFilm'       =>  $id,
            'estActif'          =>  '1',
        );

        $this->getDbTable()->insert($data);
    }

    public function ajouterMediaBluRay($id)
    {
        $data = array(
            'type_media'        =>  'BLURAY',
            'Film_idFilm'       =>  $id,
            'estActif'          =>  '1',
        );

        $this->getDbTable()->insert($data);
    }

    public function desactiveMedia($id)
    {
        var_dump($id);
        $estActif = 0;
        $data = array(
            'estActif' => $estActif,
        );
        $this->getDbTable()->update($data, array('id = ?' => $id));
    }

    public function obtenirAllMedia($filmIdFilm)
    {
        $sql = "SELECT  id
                        , type_media
                FROM    media
                WHERE   Film_idFilm = " . $filmIdFilm ."
                AND     estActif = 1;";

        $recup = $this->_db->fetchAll($sql);

        $tab = array();

        foreach ($recup as $row) {
            $media = new Application_Model_Media();
            $media ->setId($row['id'])
                    ->setTypeMedia($row['type_media']);

            $tab[] = $media;
        }

        return $tab;
    }
}
