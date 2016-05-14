<?php

class PersonneController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $personnes = new Application_Model_DbTable_Personne();
        $this->view->personne = $personnes->fetchAll();
    }

    public function ajouterAction()
    {
        // action body
    }

    public function modifierAction()
    {
        // action body
    }

    public function consulterAction()
    {
        // action body
    }

    public function desactiveAction()
    {
        // action body
    }

    public function rechercherAction()
    {
        // action body
    }


}
