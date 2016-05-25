<?php

class Application_Model_Personne
{
    protected $_id;
    protected $_prenom;
    protected $_nom;
    protected $_courriel;
    protected $_adresse1;
    protected $_adresse2;
    protected $_codePostal;
    protected $_ville;
    protected $_desactive;
    protected $_dateCreation;
    protected $_numeroAdherent;
    protected $_password;
    protected $_estEmploye;

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

    public function setPrenom($prenom)
    {
        $this->_prenom = (string) $prenom;
        return $this;
    }

    public function getPrenom()
    {
        return $this->_prenom;
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

    public function setCourriel($courriel)
    {
        $this->_courriel = (string) $courriel;
        return $this;
    }

    public function getCourriel()
    {
        return $this->_courriel;
    }

    public function setAdresse1($adresse1)
    {
        $this->_adresse1 = (string) $adresse1;
        return $this;
    }

    public function getAdresse1()
    {
        return $this->_adresse1;
    }

    public function setAdresse2($adresse2)
    {
        $this->_adresse2 = (string) $adresse2;
        return $this;
    }

    public function getAdresse2()
    {
        return $this->_adresse2;
    }

    public function setCodePostal($codePostal)
    {
        $this->_codePostal = (string) $codePostal;
        return $this;
    }

    public function getCodePostal()
    {
        return $this->_codePostal;
    }

    public function setVille($ville)
    {
        $this->_ville = (string) $ville;
        return $this;
    }

    public function getVille()
    {
        return $this->_ville;
    }

    public function setDesactive($desactive)
    {
        $this->_desactive = (int) $desactive;
        return $this;
    }

    public function getDesactive()
    {
        return $this->_desactive;
    }

    public function setDateCreation($dateCreation)
    {
        $this->_dateCreation = (datetime) $dateCreation;
        return $this;
    }

    public function getDateCreation()
    {
        return $this->_dateCreation;
    }

    public function setNumeroAdherent($numeroAdherent)
    {
        $this->_numeroAdherent = (string) $numeroAdherent;
        return $this;
    }

    public function getNumeroAdherent()
    {
        return $this->_numeroAdherent;
    }

    public function setPassoword($password)
    {
        $this->_password = (string) $password;
        return $this;
    }

    public function getPassoword()
    {
        return $this->_password;
    }

    public function setEstEmploye($estEmploye)
    {
        $this->_estEmploye = (int) $estEmploye;
        return $this;
    }

    public function getEstEmploye()
    {
        return $this->_estEmploye;
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
