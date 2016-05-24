<?php
class GenreController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listeAction()
    {
        $genre = new Application_Model_GenreMapper();
        $this->view->entries = $genre->fetchAll();
    }

    public function ajouterAction()
    {
    //   $form = new Application_Form_Genre();
    //   $form->envoyer->setLabel('Ajouter');
    //   $this->view->form = $form;
    //   if ($this->getRequest()->isPost()) {
    //       $formData = $this->getRequest()->getPost();
    //       if ($form->isValid($formData)) {
    //           $genre = $form->getValue('genre');
    //           $genres = new Application_Model_DbTable_Genre();
    //           $genres->ajouterGenre($genre);
    //           $this->_helper->redirector('index');
    //       } else {
    //           $form->populate($formData);
    //       }
    //   }
    //
        $request = $this->getRequest();
        $form    = new Application_Form_Genre();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $genre = new Application_Model_Genre($form->getValues());
                $mapper  = new Application_Model_GenreMapper();
                $mapper->save($genre);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }

    public function modifierAction()
    {
      $form = new Application_Form_Genre();
      $form->envoyer->setLabel('Sauvegarder');
      $this->view->form = $form;
      if ($this->getRequest()->isPost()) {
          $formData = $this->getRequest()->getPost();
          if ($form->isValid($formData)) {
              $id = $form->getValue('id');
              $genre = $form->getValue('genre');
              $genres = new Application_Model_DbTable_Genre();
              $genres->modifierGenre($id, $genre);
              $this->_helper->redirector('index');
          } else {
              $form->populate($formData);
          }
      } else {
          $id = $this->_getParam('id', 0);
          if ($id > 0) {
              $genres = new Application_Model_DbTable_Genre();
              $form->populate($genres->obtenirGenre($id));
          }
      }
    }

    public function supprimerAction()
    {
      if ($this->getRequest()->isPost()) {
         $supprimer = $this->getRequest()->getPost('supprimer');
         if ($supprimer == 'Oui') {
             $id = $this->getRequest()->getPost('id');
             $genres = new Application_Model_DbTable_Genre();
             $genres->supprimerGenre($id);
         }
         $this->_helper->redirector('index');
       } else {
          $id = $this->_getParam('id', 0);
          $genres = new Application_Model_DbTable_Genre();
          $this->view->genre = $genres->obtenirGenre($id);
       }
    }
}
