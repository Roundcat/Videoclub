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
        $mapper = new Application_Model_GenreMapper();
        $this->view->entries = $mapper->fetchAll();
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
                // $genre = $mapper->obtenirGenre($id);
                // $this->view->genre = $genre;
            }
    }
}
