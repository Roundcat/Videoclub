<?php

class ActeurRealisateurController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $ActeurRealisateurs = new Application_Model_DbTable_ActeurRealisateur();
      $this->view->acteurRealisateur = $ActeurRealisateurs->fetchAll();
    }

    public function ajouterAction()
    {
        // action body
    }

    public function modifierAction()
    {
        // action body
    }


}
