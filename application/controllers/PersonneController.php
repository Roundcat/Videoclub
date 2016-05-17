<?php

class PersonneController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    /**
     * Action : Affiche tous les clients et tous les employés présents en base
     * View : personne/index
     */
    public function indexAction()
    {
        $personnes = new Application_Model_DbTable_Personne();
        $this->view->personne = $personnes->fetchAll();
    }

    /**
     * Action : Ajoute une personne en base
     * Form : Application_Form_Personne
     * View : personne/ajouter
     */
    public function ajouterAction()
    {
      // Instanciation de Application_Form_Personne
      $form = new Application_Form_Personne();
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
          $nom        = $form->getValue('nom');
          $prenom     = $form->getValue('prenom');
          $password   = $form->getValue('motDePasse');
          $courriel   = $form->getValue('courriel');
          $adresse1   = $form->getValue('adresse1');
          $adresse2   = $form->getValue('adresse2');
          $codePostal = $form->getValue('code_postal');
          $ville      = $form->getValue('ville');
          $estEmploye = $form->getValue('estEmploye');
          $personnes  = new Application_Model_DbTable_Personne();
      $personnes->ajouterPersonne($nom, $prenom, $password, $courriel, $adresse1, $adresse2, $codePostal, $ville, $estEmploye);

          // Après avoir sauvegardé le nouvel enregistrement d'acteur réalisateur
          // redirection vers l'action index avec l'aide d'action Redirector
          // Ici retour vers la page d'accueil
          $this->_helper->flashMessenger->addMessage('Personne ajoutée correctement');
          $this->_helper->redirector('index');
          // Si les données du formulaire ne sont pas valides
          // nouvel affichage du formulaire avec les données fournies
        } else {
          $form->populate($formData);
        }
      }
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
