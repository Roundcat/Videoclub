<?php

class LocationController extends Zend_Controller_Action
{

    protected $_flashMessenger = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->_flashMessenger = $this->_helper
                                      ->getHelper('FlashMessenger');
        $this->initView();
    }

    public function indexAction()
    {
        // action body
    }

    public function saisirSortieAction()
    {
        $request    = $this->getRequest();
        $form       = new Application_Form_Location();
        $form->submit->setLabel('Ajouter');

        // Affocher les films dans une liste déroulante
        $filmMapper = new Application_Model_FilmMapper();
        $films = $filmMapper->fetchAll();
        $options = array();
        foreach ($films as $film) {
            $value = $film->getNom();
            $options[$film->getId()] = $value;
        }
        $element = $form->getElement('realisateurId');
        $element->setMultiOptions($options);

        $clientMapper = new Application_Model_PersonneMapper();
        $clients = $clientMapper->obtenirAllClients();
        $options = array();
        foreach ($clients as $client) {
            $value = $client->getPrenom() . " " . $client->getNom();
            $options[$client->getId()] = $value;
        }
        $element = $form->getElement('Personne_id');
        $element->setMultiOptions($options);

        if ($request->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $location = new Application_Model_Location($form->getValues());

                $dateLocation = date("d-m-Y");
                $location->setDateLocation($dateLocation);

                $mapper   = new Application_Model_LocationMapper();

                $mapper->saisirSortieLocation($location);
                return $this->_helper->redirector('index', 'Index');
            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }

    }

    public function saisirRetourAction()
    {
        // action body
    }

    public function listeSortieAction()
    {
        // action body
    }


}
