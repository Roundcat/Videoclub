<?php

class Application_Model_Genre
{
    protected $_id;
    protected $_genre;

    public function __construct(array $options = null/*, int $pid = NULL*/)
    {
        // if (isset($pid)) {
        //     $mapper = new Application_Model_GenreMapper();
        //     $genre = new Application_Model_Genre();
        //     $mapper->obtenirGenre($pid, $genre);
        //     $this->_id = $genre->getId();
        //     $this->_genre = $genre->getGenre();
        // } else {
            if (is_array($options)) {
                $this->setOptions($options);
            }
        //  }
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

    public function setGenre($genre)
    {
        $this->_genre = (string) $genre;
        return $this;
    }

    public function getGenre()
    {
        return $this->_genre;
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
}
