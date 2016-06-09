<?php

class Application_Model_Media
{
    protected $_id;
    protected $_type_media;
    protected $_Film_idFilm;
    protected $_estActif;

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

    public function setTypeMedia($typeMedia)
    {
        $this->_type_media = (string) $typeMedia;
        return $this;
    }

    public function getTypeMedia()
    {
        return $this->_type_media;
    }

    public function setFilmIdFilm($filmIdFilm)
    {
        $this->_Film_idFilm = (int) $filmIdFilm;
        return $this;
    }

    public function getFilmIdFilm()
    {
        return $this->_Film_idFilm;
    }

    public function setEstActif($estActif)
    {
        $this->_estActif = (int) $estActif;
        return $this;
    }

    public function getEstActif()
    {
        return $this->_estActif;
    }

}
