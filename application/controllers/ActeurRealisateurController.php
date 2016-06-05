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
        // Instanciation de Application_Form_ActeurRealisateur
        $form = new Application_Form_ActeurRealisateur();
        // Affectation au bouton d'envoi le libellé 'Ajouter'
        $form->envoyer->setLabel('Ajouter');
        // Assignation du formulaire à la vue pour l'affichage
        $this->view->form = $form;

        // Si la méthode isPost() de l'objet de requête renvoie true, alors le formulaire a été envoyé
        if ($this->getRequest()->isPost()) {
          // Récupération des données de la requête avec la méthode getPost()
          $formData = $this->getRequest()->getPost();
          // Vérification que les données de la requête soient valides avec la méthode membre isValid()
          if ($form->isValid($formData)) {
            // Si le formulaire est valide
            // instanciation de la classe modèle Application_Model_DbTable_ActeurRealisateur
            // et utilisation de la méthode ajouterActeurRealisateur() créée dans la classe Application_Model_DbTable_ActeurRealisateur
            // pour créer un nouvel enregistrment dans la base de données
            $nom      = $form->getValue('nom');
            $prenom   = $form->getValue('prenom');
            $acteurRealisateurs = new Application_Model_DbTable_ActeurRealisateur();
            $acteurRealisateurs->ajouterActeurRealisateur($nom, $prenom);

            // Après avoir sauvegardé le nouvel enregistrement d'acteur réalisateur
            // redirection vers l'action index avec l'aide d'action Redirector
            // Ici retour vers la page d'accueil
            $this->_helper->redirector('index');
            // Si les données du formulaire ne sont pas valides
            // nouvel affichage du formulaire avec les données fournies
          } else {
            $form->populate($formData);
          }
        }
    }

    /**
     * Action : Modifie un acteur ou un réalisateur en base
     * Form : Application_Form_ActeurRealisateur
     * View : acteur-realisateur/modifier
     */
    public function modifierAction()
    {
      // Instanciation de Application_Form_ActeurRealisateur
      $form = new Application_Form_ActeurRealisateur();
      // Affectation au bouton d'envoi le libellé 'Sauvegarder'
      $form->envoyer->setLabel('Sauvegarder');
      // Assignation du formulaire à la vue pour l'affichage
      $this->view->form = $form;

      // Si la méthode isPost() de l'objet de requête renvoie true, alors le formulaire a été envoyé
      if ($this->getRequest()->isPost()) {
          // Récupération des données de la requête avec la méthode getPost()
          $formData = $this->getRequest()->getPost();
          // Vérification que les données de la requête soient valides avec la méthode membre isValid()
              if ($form->isValid($formData)) {
                  // Si le formulaire est valide
                  // instanciation de la classe modèle Application_Model_DbTable_ActeurRealisateur
                  // et utilisation de la méthode modifierActeurRealisateur() créée dans la classe Application_Model_DbTable_ActeurRealisateur
                  // pour sauvegarder les données sur le bon enregistrement dans la base de données
                  $id       = $form->getValue('id');
                  $nom      = $form->getValue('nom');
                  $prenom   = $form->getValue('prenom');
                  $acteurRealisateurs = new Application_Model_DbTable_ActeurRealisateur();
                  $acteurRealisateurs->modifierActeurRealisateur($id, $nom, $prenom);

                  // Après avoir sauvegardé le nouvel enregistrement d'acteur réalisateur
                  // redirection vers l'action index avec l'aide d'action Redirector
                  // Ici retour vers la page d'accueil
                  $this->_helper->redirector('index');
                  // Si les données du formulaire ne sont pas valides
                  // nouvel affichage du formulaire avec les données fournies
              } else {
                  $form->populate($formData);
              }
      } else {
        // Récupération de l'id de la requête en utilisant la méthode _getParam()
        // Ensuite utilisation du modèle pour récupérer l'enregistrement de la abse de données
        // et remplir le formulaire directement avec les données de l'enregistrement
          $id = $this->_getParam('id', 0);
          if ($id > 0) {
              $acteurRealisateurs = new Application_Model_DbTable_ActeurRealisateur();
              $form->populate($acteurRealisateurs->obtenirActeurRealisateur($id));
          }
      }
    }

}
