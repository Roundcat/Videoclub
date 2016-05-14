<?php

class ActeurRealisateurController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      $acteurRealisateurs = new Application_Model_DbTable_ActeurRealisateur();
      $this->view->acteurRealisateur = $acteurRealisateurs->fetchAll();
    }

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

    public function modifierAction()
    {
        // action body
    }


}
