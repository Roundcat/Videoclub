<?php

class ActeurRealisateurController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    /**
     * Action : Affiche tous les acteurs et réalisateurs présents en base
     * View : acteur-realisateur/liste
     */
    public function listeAction()
    {
        // Configuration du script de navigation. Voyez le tutoriel sur le script
        // des éléments de contrôle de la pagination pour plus d'informations
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');

        $mapper = new Application_Model_ActeurRealisateurMapper();
        $acteurRealisateur = new Application_Model_ActeurRealisateur();
        $acteurRealisateur = $mapper->fetchAll();
        // Créons un paginateur pour cette requête
        $paginator = Zend_Paginator::factory($acteurRealisateur);

        // Nous lisons le numéro de page depuis la requête. Si le paramètre n'est pas précisé
        // la valeur 1 sera utilisée par défaut
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));

        // Assignons enfin l'objet Paginator à notre vue
        $this->view->paginator = $paginator;

    }

    /**
     * Action : Ajoute un acteur ou un réalisateur en base
     * Form : Application_Form_ActeurRealisateur
     * View : acteur-realisateur/ajouter
     */
    public function ajouterAction()
    {
        $request    = $this->getRequest();
        $form       = new Application_Form_ActeurRealisateur();
        $form->submit->setLabel('Ajouter');
        if ($request->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $acteurRealisateur = new Application_Model_ActeurRealisateur($form->getValues());

                $mapper   = new Application_Model_ActeurRealisateurMapper();
                $test = $mapper->ajouterActeurRealisateur($acteurRealisateur);
                return $this->_helper->redirector('liste');
            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }

    /**
     * Action : Modifie un acteur ou un réalisateur en base
     * Form : Application_Form_ActeurRealisateur
     * View : acteur-realisateur/modifier
     */
    public function modifierAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_ActeurRealisateur();
        $form->submit->setLabel('Modifier');

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $this->_getParam('id', 0);
                $prenom     =   $form->getValue('prenom');
                $nom        =   $form->getValue('nom');
                $mapper  = new Application_Model_ActeurRealisateurMapper();
                $mapper->modifierActeurRealisateur($id, $prenom, $nom);
                return $this->_helper->redirector('liste');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $mapper  = new Application_Model_ActeurRealisateurMapper();
                $acteurRealisateur = new Application_Model_ActeurRealisateur();
                $acteurRealisateur = $mapper->obtenirActeurRealisateur($id);

                $form->populate(array(  'prenom'  =>$acteurRealisateur->prenom,
                                        'nom'     =>$acteurRealisateur->nom
                                     ));
            }
        }

        $this->view->form = $form;
    }
}
