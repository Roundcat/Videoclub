<?php

class Application_Model_Location
{
    protected $_idlocation;
    protected $_Personne_id;
    protected $_media_id;
    protected $_date_location;
    protected $_date_retour;

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
        $this->_idlocation = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_idlocation;
    }

    public function setPersonneId($personneId)
    {
        $this->_Personne_id = (int) $personneId;
        return $this;
    }

    public function getPersonneId()
    {
        return $this->_Personne_id;
    }

    public function setMediaId($mediaId)
    {
        $this->_media_id = (int) $mediaId;
        return $this;
    }

    public function getMediaId()
    {
        return $this->_media_id;
    }

    public function setDateLocation($dateLocation)
    {
        $this->_date_location = $dateLocation;
        return $this;
    }

    public function getDateLocation()
    {
        return $this->_date_location;
    }

    public function setDateRetour($dateRetour)
    {
        $this->_date_retour = $dateRetour;
        return $this;
    }

    public function getDateRetour()
    {
        return $this->_date_retour;
    }
}
