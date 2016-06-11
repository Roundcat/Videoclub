<?php

class FilmController extends Zend_Controller_Action
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

    public function ajouterAction()
    {
        $request    = $this->getRequest();
        $form       = new Application_Form_Film();
        $form->submit->setLabel('Ajouter');

        // Afficher les réalisateurs et les acteurs dans leur liste déroulante respective
        $realisateurMapper = new Application_Model_ActeurRealisateurMapper();
        $realisateurs = $realisateurMapper->fetchAll();
        $options = array();
        foreach ($realisateurs as $realisateur) {
            $value = $realisateur->getPrenom() . " " . $realisateur->getNom();
            $options[$realisateur->getId()] = $value;
        }
        $element = $form->getElement('realisateurId');
        $element->setMultiOptions($options);

        $element = $form->getElement('acteur1');
        $element->setMultiOptions($options);

        $element = $form->getElement('acteur2');
        $element->setMultiOptions($options);

        $element = $form->getElement('acteur3');
        $element->setMultiOptions($options);

        $genreMapper = new Application_Model_GenreMapper();
        $genres = $genreMapper->fetchAll();
        $options = array();
        foreach ($genres as $genre) {
            $value = $genre->getGenre();
            $options[$genre->getId()] = $value;
        }
        $element = $form->getElement('genre');
        $element->setMultiOptions($options);

        if ($request->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $film = new Application_Model_Film($form->getValues());

                $date = date("Y-m-d");
                $film->setDateCreation($date);

                $mapper   = new Application_Model_FilmMapper();

                $mapper->ajouterFilm($film);
                return $this->_helper->redirector('index', 'Index');
            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }

    public function modifierAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Film();
        $form->submit->setLabel('Modifier');

        // Afficher les réalisateurs et les acteurs dans leur liste déroulante respective
        $realisateurMapper = new Application_Model_ActeurRealisateurMapper();
        $realisateurs = $realisateurMapper->fetchAll();
        $options = array();
        foreach ($realisateurs as $realisateur) {
            $value = $realisateur->getPrenom() . " " . $realisateur->getNom();
            $options[$realisateur->getId()] = $value;
        }
        $element = $form->getElement('realisateurId');
        $element->setMultiOptions($options);

        $element = $form->getElement('acteur1');
        $element->setMultiOptions($options);

        $element = $form->getElement('acteur2');
        $element->setMultiOptions($options);

        $element = $form->getElement('acteur3');
        $element->setMultiOptions($options);

        $genreMapper = new Application_Model_GenreMapper();
        $genres = $genreMapper->fetchAll();
        $options = array();
        foreach ($genres as $genre) {
            $value = $genre->getGenre();
            $options[$genre->getId()] = $value;
        }
        $element = $form->getElement('genre');
        $element->setMultiOptions($options);

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id             =   $this->_getParam('id', 0);
                $nom            =   $form->getValue('nom');
                $dateFilm       =   $form->getValue('dateFilm');
                $resume         =   $form->getValue('resume');
                $realisateurId  =   $form->getValue('realisateurId');
                $acteur1        =   $form->getValue('acteur1');
                $acteur2        =   $form->getValue('acteur2');
                $acteur3        =   $form->getValue('acteur3');
                $genre          =   $form->getValue('genre');

                $mapper  = new Application_Model_FilmMapper();
                $mapper->modifierFilm($id, $nom, $dateFilm, $resume, $realisateurId, $acteur1, $acteur2, $acteur3, $genre);
                return $this->_helper->redirector('index', 'Index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $mapper  = new Application_Model_FilmMapper();
                $film = new Application_Model_Film();
                $film = $mapper->obtenirFilm($id);
                $form->populate(array(  'nom'              =>$film->getNom(),
                                        'dateFilm'         =>$film->getDateFilm(),
                                        'resume'           =>$film->getResume(),
                                        'realisateurId'    =>$film->getRealisateurId(),
                                        'acteur1'          =>$film->getActeur1(),
                                        'acteur2'          =>$film->getActeur2(),
                                        'acteur3'          =>$film->getActeur3(),
                                        'genre'            =>$film->getGenre(),
                                     ));
            }
        }

        $this->view->form = $form;
    }

    public function detailAction()
    {
        $id = $this->_getParam('id', 0);
        $mapper  = new Application_Model_FilmMapper();
        $film = new Application_Model_Film();
        $film = $mapper->obtenirFilm($id);
        $this->view->film = $film;

        // Récupérer le prénom et le nom du réalisateur et des acteurs pour affichage
        $realisateurMapper = new Application_Model_ActeurRealisateurMapper();

        $realisateur = $realisateurMapper->obtenirActeurRealisateur($film->getRealisateurId());
        $this->view->realisateur = $realisateur->getPrenom() . " " . $realisateur->getNom();

        $acteur1 = $realisateurMapper->obtenirActeurRealisateur($film->getActeur1());
        $this->view->acteur1 = $acteur1->getPrenom() . " " . $acteur1->getNom();

        $acteur2 = $realisateurMapper->obtenirActeurRealisateur($film->getActeur2());
        $this->view->acteur2 = $acteur2->getPrenom() . " " . $acteur2->getNom();

        $acteur3 = $realisateurMapper->obtenirActeurRealisateur($film->getActeur3());
        $this->view->acteur3 = $acteur3->getPrenom() . " " . $acteur3->getNom();

        // Récupérer le genre du film pour affichage
        $genreMapper = new Application_Model_GenreMapper();

        $genre = $genreMapper->obtenirGenre($film->getGenre());
        $this->view->genre = $genre->getGenre();

    }

    public function listeAction()
    {
        // Configuration du script de navigation. Voyez le tutoriel sur le script
        // des éléments de contrôle de la pagination pour plus d'informations
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');

        $mapper = new Application_Model_FilmMapper();
        $film = new Application_Model_Film();
        $film = $mapper->obtenirAllFilms();

        // Créons un paginateur pour cette requête
        $paginator = Zend_Paginator::factory($film);

        // Nous lisons le numéro de page depuis la requête. Si le paramètre n'est pas précisé
        // la valeur 1 sera utilisée par défaut
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));

        // Assignons enfin l'objet Paginator à notre vue
        $this->view->paginator = $paginator;
    }

    public function ajoutermediabluerayAction()
    {
        $id = $this->_getParam('id', 0);

        $mediaMapper = new Application_Model_MediaMapper();
        $media = new Application_Model_Media();
        $media = $mediaMapper->ajouterMediaBluRay($id);

        return $this->_helper->redirector('liste', 'Film');
    }

    public function ajoutermediadvdAction()
    {
        $id = $this->_getParam('id', 0);

        $mediaMapper = new Application_Model_MediaMapper();
        $media = new Application_Model_Media();
        $media = $mediaMapper->ajouterMediaDVD($id);

        return $this->_helper->redirector('liste', 'Film');
    }

    public function listemediaAction()
    {
        // Configuration du script de navigation. Voyez le tutoriel sur le script
        // des éléments de contrôle de la pagination pour plus d'informations
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');

        $filmIdFilm = $this->_getParam('id', 0);

        $mapper = new Application_Model_MediaMapper();
        $media = new Application_Model_Media();
        $media = $mapper->obtenirAllMedia($filmIdFilm);

        // Créons un paginateur pour cette requête
        $paginator = Zend_Paginator::factory($media);

        // Nous lisons le numéro de page depuis la requête. Si le paramètre n'est pas précisé
        // la valeur 1 sera utilisée par défaut
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));

        // Assignons enfin l'objet Paginator à notre vue
        $this->view->paginator = $paginator;
    }

    public function desactiveAction()
    {
        if ($this->getRequest()->isPost()) {
            $desactiver = $this->getRequest()->getPost('desactive');
            if ($desactiver == 'Oui') {
                $id = $this->_getParam('id', 0);
                $mapper = new Application_Model_MediaMapper();
                $media = new Application_Model_Media();
                $media = $mapper->desactiveMedia($id);
            }
            $this->_helper->redirector('liste', 'Film');
        } else {
            $id = $this->_getParam('id', 0);
            $mapper  = new Application_Model_MediaMapper();
            $media = new Application_Model_Media();
            $media = $mapper->obtenirAllMedia($id);var_dump($mapper->obtenirAllMedia($id));
            $this->view->film = $media; var_dump($media);
        }
    }
}
