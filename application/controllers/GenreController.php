<?php
class GenreController extends Zend_Controller_Action
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

    public function listeAction()
    {
        // Configuration du script de navigation. Voyez le tutoriel sur le script
        // des éléments de contrôle de la pagination pour plus d'informations
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');

        $mapper = new Application_Model_GenreMapper();
        $genre = new Application_Model_Genre();
        $genre = $mapper->fetchAll();
        // Créons un paginateur pour cette requête
        $paginator = Zend_Paginator::factory($genre);

        // Nous lisons le numéro de page depuis la requête. Si le paramètre n'est pas précisé
        // la valeur 1 sera utilisée par défaut
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));

        // Assignons enfin l'objet Paginator à notre vue
        $this->view->paginator = $paginator;
    }

    public function ajouterAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Genre();
        $form->submit->setLabel('Ajouter');

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $genre = new Application_Model_Genre($form->getValues());
                $mapper  = new Application_Model_GenreMapper();
                $mapper->ajouterGenre($genre);
                return $this->_helper->redirector('liste');
            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }

    public function modifierAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Genre();
        $form->submit->setLabel('Modifier');

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = $this->_getParam('id', 0);
                $genre = $form->getValue('genre');
                $mapper  = new Application_Model_GenreMapper();
                $mapper->modifierGenre($id, $genre);
                return $this->_helper->redirector('liste');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $mapper  = new Application_Model_GenreMapper();
                $genre = new Application_Model_Genre();
                $genre = $mapper->obtenirGenre($id);
                $form->populate(array('genre'=>$genre->genre));
            }
        }

        $this->view->form = $form;
    }

    public function supprimerAction()
    {
        if ($this->getRequest()->isPost()) {
            $supprimer = $this->getRequest()->getPost('supprimer');
            if ($supprimer == 'Oui') {
                $id = $this->_getParam('id', 0);
                $mapper = new Application_Model_GenreMapper();
                $genre = new Application_Model_Genre();
                $genre = $mapper->supprimerGenre($id);
            }
            $this->_helper->redirector('liste');
            } else {
                $id = $this->_getParam('id', 0);
                $mapper  = new Application_Model_GenreMapper();
                $genre = new Application_Model_Genre();
                $genre = $mapper->obtenirGenre($id);
                $this->view->genre = $genre;
            }
    }
}
