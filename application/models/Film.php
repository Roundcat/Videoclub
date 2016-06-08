<?php

class Application_Model_Film
{
    protected $_id;
    protected $_nom;
    protected $_dateFilm;
    protected $_resume;
    protected $_dateCreation;
    protected $_realisateurId;
    protected $_acteur1;
    protected $_acteur2;
    protected $_acteur3;
    protected $_genre;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    // __set et __get pour simplifier l'accès aux attributs et proxier vers les autres getters et setters.
    // Permettront d'assurer que seuls les attributs définis seront accessibles dans l'objet
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid genre property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid genre property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setNom($nom)
    {
        $this->_nom = (string) $nom;
        return $this;
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function setDateFilm($dateFilm)
    {
        $this->_dateFilm = $dateFilm;
        return $this;
    }

    public function getDateFilm()
    {
        return $this->_dateFilm;
    }

    public function setResume($resume)
    {
        $this->_resume = (string) $resume;
        return $this;
    }

    public function getResume()
    {
        return $this->_resume;
    }

    public function setDateCreation($dateCreation)
    {
        $this->_dateCreation = $dateCreation;
        return $this;
    }

    public function getDateCreation()
    {
        return $this->_dateCreation;
    }

    public function setRealisateurId($realisateur)
    {
        $this->_realisateurId = (int) $realisateur;
        return $this;
    }

    public function getRealisateurId()
    {
        return $this->_realisateurId;
    }

    public function setActeur1($acteur1)
    {
        $this->_acteur1 = (int) $acteur1;
        return $this;
    }

    public function getActeur1()
    {
        return $this->_acteur1;
    }

    public function setActeur2($acteur2)
    {
        $this->_acteur2 = (int) $acteur2;
        return $this;
    }

    public function getActeur2()
    {
        return $this->_acteur2;
    }

    public function setActeur3($acteur3)
    {
        $this->_acteur3 = (int) $acteur3;
        return $this;
    }

    public function getActeur3()
    {
        return $this->_acteur3;
    }

    public function setGenre($genre)
    {
        $this->_genre = (int) $genre;
        return $this;
    }

    public function getGenre()
    {
        return $this->_genre;
    }
}
