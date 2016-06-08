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

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id             =   $this->_getParam('id', 0);
                $nom            =   $form->getValue('nom');
                $dateFilm       =   $form->getValue('date_film');
                $resume         =   $form->getValue('resume');
                $realisateur    =   $form->getValue('realisateur_id');
                $acteur1        =   $form->getValue('acteur1');
                $acteur2        =   $form->getValue('acteur2');
                $acteur3        =   $form->getValue('acteur3');
                $genre          =   $form->getValue('id_genre');

                $mapper  = new Application_Model_FilmMapper();
                $mapper->modifierFilm($id, $nom, $dateFilm, $resume, $realisateur, $acteur1, $acteur2, $acteur3, $genre);
                return $this->_helper->redirector('index', 'Index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $mapper  = new Application_Model_FilmMapper();
                $film = new Application_Model_Film();
                $film = $mapper->obtenirFilm($id); var_dump($mapper->obtenirFilm($id));
                $form->populate(array(  'nom'               =>$film->nom,
                                        'date_film'         =>$film->dateFilm,
                                        'resume'            =>$film->resume,
                //                         'realisateur_id'    =>$film->realisateurID,
                                        'acteur1'           =>$film->acteur1,
                                        'acteur2'           =>$film->acteur2,
                                        'acteur3'           =>$film->acteur3,
                                        'id_genre'          =>$film->genre,
                                     ));
            }
        }

        $this->view->form = $form;
    }

    public function desactiveAction()
    {
        // action body
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

    public function detailAction()
    {
        // action body
    }


}


