<?php

class PersonneController extends Zend_Controller_Action
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

    public function listeClientAction()
    {
        // Configuration du script de navigation. Voyez le tutoriel sur le script
        // des éléments de contrôle de la pagination pour plus d'informations
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');

        $mapper = new Application_Model_PersonneMapper();
        $client = new Application_Model_Personne();
        $client = $mapper->obtenirAllClients();

        // Créons un paginateur pour cette requête
        $paginator = Zend_Paginator::factory($client);

        // Nous lisons le numéro de page depuis la requête. Si le paramètre n'est pas précisé
        // la valeur 1 sera utilisée par défaut
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));


        // Assignons enfin l'objet Paginator à notre vue
        $this->view->paginator = $paginator;

        // $this->view->personne = $client; // déclaration utilisée pour la vue liste-client.phtml
    }

    public function listeEmployeAction()
    {
        $mapper = new Application_Model_PersonneMapper();
        $employe = new Application_Model_Personne();
        $employe = $mapper->obtenirAllEmployes();
        $this->view->personne = $employe; // déclaration utilisée pour la vue liste-employe.phtml
    }

    /**
     * Action : Affiche tous les clients et tous les employés présents en base
     * View : personne/liste
     */
    public function listeAction()
    {
        $mapper = new Application_Model_PersonneMapper();
        $this->view->entries = $mapper->fetchAll();
    }

    /**
     * Action : Ajoute une personne en base
     * Form : Application_Form_Personne
     * View : personne/ajouter
     */
    public function ajouterAction()
    {
        $request    = $this->getRequest();
        $form       = new Application_Form_Personne();
        $form->submit->setLabel('Ajouter');
        if ($request->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $personne = new Application_Model_Personne($form->getValues());

                // génération du numéro d'adhérent
                $t = time();
                $r = rand(10,99);
                $numeroAdherent = $t.$r;
                // ajout du numéro d'adhérent à l'objet personne
                $personne->setNumeroAdherent($numeroAdherent);

                // ajout de la date création à l'objet personne
                $date = date("Y-m-d");
                $personne->setDateCreation($date);

                // mise à 0 de la désactivation
                $desactive = 0;
                $personne->setDesactive($desactive);

                $mapper   = new Application_Model_PersonneMapper();
                $test = $mapper->ajouterPersonne($personne);
                return $this->_helper->redirector('liste');
            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }

    /**
     * Action : Modifie une personne en base
     * Form : Application_Form_Personne
     * View : personne/modifier
     */
    public function modifierAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Personne();
        $form->submit->setLabel('Modifier');

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $this->_getParam('id', 0);
                $prenom     =   $form->getValue('prenom');
                $nom        =   $form->getValue('nom');
                $courriel   =   $form->getValue('courriel');
                $adresse1   =   $form->getValue('adresse1');
                $adresse2   =   $form->getValue('adresse2');
                $codePostal =   $form->getValue('code_postal');
                $ville      =   $form->getValue('ville');
                $password   =   $form->getValue('motDePasse');
                $estEmploye =   $form->getValue('estEmploye');
                $mapper  = new Application_Model_PersonneMapper();
                $mapper->modifierPersonne($id, $prenom, $nom, $courriel, $adresse1, $adresse2, $codePostal, $ville, $password, $estEmploye);
                return $this->_helper->redirector('liste');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $mapper  = new Application_Model_PersonneMapper();
                $personne = new Application_Model_Personne();
                $personne = $mapper->obtenirPersonne($id);

                $form->populate(array(  'prenom'        =>$personne->prenom,
                                        'nom'           =>$personne->nom,
                                        'courriel'      =>$personne->courriel,
                                        'adresse1'      =>$personne->adresse1,
                                        'adresse2'      =>$personne->adresse2,
                                        'code_postal'   =>$personne->codePostal,
                                        'ville'         =>$personne->ville,
                                        'motDePasse'    =>$personne->password,
                                        'estEmployé'    =>$personne->estEmploye
                                     ));
            }
        }

        $this->view->form = $form;
    }

    public function detailAction()
    {
        $request = $this->getRequest();

        if ($this->getRequest()->isPost()) {


            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $mapper  = new Application_Model_PersonneMapper();
                $personne = new Application_Model_Personne();
                $personne = $mapper->obtenirPersonne($id);

                $form->populate(array(  'prenom'        =>$personne->prenom,
                                        'nom'           =>$personne->nom,
                                        'courriel'      =>$personne->courriel,
                                        'adresse1'      =>$personne->adresse1,
                                        'adresse2'      =>$personne->adresse2,
                                        'code_postal'   =>$personne->codePostal,
                                        'ville'         =>$personne->ville,
                                        'motDePasse'    =>$personne->password,
                                        'estEmployé'    =>$personne->estEmploye
                                     ));
            }
        }

        $this->view->personne = $detail;
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
