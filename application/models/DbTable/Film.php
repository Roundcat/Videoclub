<?php

class Application_Model_DbTable_Film extends Zend_Db_Table_Abstract
{

    protected $_name = 'film';

    public function getName()
    {
        return $this->_name;
    }

    // public function obtenirFilm($id)
    // {
    //     $id = (int)$id;
    //     $row = $this->fetchRow('id = ' . $id);
    //     if (!$row) {
    //         throw new Exception("Impossible de trouver l'enregistrement $id");
    //     }
    //     return $row->toArray();
    // }
    //
    // public function ajouterFilm($nom, $resume, $dateFilm, $realisateur, $acteur1, $acteur2 = null, $acteur3 = null, $idGenre)
    // {
    //     $data = array(
    //         'nom'             =>  $nom,
    //         'resume'          =>  $resume,
    //         'date_film'       =>  $dateFilm,
    //         'realisateur_id'  =>  $realisateur,
    //         'acteur1'         =>  $acteur1,
    //         'acteur2'         =>  $acteur2,
    //         'acteur3'         =>  $acteur3,
    //         'id_genre'        =>  $idGenre,
    //     );
    //     $this->insert($data);
    // }
    //
    // public function modifierFilm($id, $nom, $resume, $dateFilm, $realisateur, $acteur1, $acteur2, $acteur3, $idGenre)
    // {
    //     $data = array(
    //         'nom'             =>  $nom,
    //         'resume'          =>  $resume,
    //         'date_film'       =>  $dateFilm,
    //         'realisateur_id'  =>  $realisateur,
    //         'acteur1'         =>  $acteur1,
    //         'acteur2'         =>  $acteur2,
    //         'acteur3'         =>  $acteur3,
    //         'id_genre'        =>  $idGenre,
    //     );
    //     $this->update($data, 'id = '. (int)$id);
    // }
}
