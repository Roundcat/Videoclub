<?php

class Application_Form_Film extends Zend_Form
{

    public function init()
    {
        // La méthode HTTP d'envoi du formulaire
        $this->setMethod('post');

        // Un élément nom
        $this->addElement('text', 'nom', array(
            'label'         =>  'Titre du film : ',
            'required'      =>  true,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'attribs'       =>  array('size' => 50),
            'validators'    =>  array(array('validator' => 'NotEmpty'))
        ));

        // Un élément date_film
        $this->addElement('text', 'dateFilm', array(
            'label'         =>  'Date de réalisation : ',
            'required'      =>  true,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'attribs'       =>  array('size' => 20),
            'validators'    =>  array(array('validator' =>  'NotEmpty',
                                                            'Date'))
        ));

        // Un élément resume
        $this->addElement('textarea', 'resume', array(
            'label'         =>  'Résumé du film : ',
            'required'      =>  true,
            'attribs'       =>  array('cols' => 50, 'rows' => 4),
            'filters'       =>  array('StripTags', 'StringTrim'),
            'validators'    =>  array(array('validator' => 'NotEmpty'))
        ));

        // Un élément realisateur_id
        $this->addElement('select', 'realisateurId', array(
            'label'         =>  'Réalisateur : ',
            'required'      =>  true,
            'filters'       =>  array('StripTags', 'StringTrim'),
            // 'attribs'       =>  array('size' => 20),
            'validators'    =>  array(array('validator' => 'NotEmpty'))
        ));

        // Un élément acteur1
        $this->addElement('select', 'acteur1', array(
            'label'         =>  'Acteur principal : ',
            'required'      =>  true,
            'filters'       =>  array('StripTags', 'StringTrim'),
            // 'attribs'       =>  array('size' => 50),
            'validators'    =>  array(array('validator' => 'NotEmpty'))
        ));

        // Un élément acteur2 (null)
        $this->addElement('select', 'acteur2', array(
            'label'         =>  'Autre acteur : ',
            'required'      =>  false,
            'filters'       =>  array('StripTags', 'StringTrim'),
            // 'attribs'       =>  array('size' => 50),
        ));

        // Un élément acteur3 (null)
        $this->addElement('select', 'acteur3', array(
            'label'         =>  'Autre acteur : ',
            'required'      =>  false,
            'filters'       =>  array('StripTags', 'StringTrim'),
            // 'attribs'       =>  array('size' => 50),
        ));

        // Un élément id_genre (null)
        $this->addElement('select', 'genre', array(
            'label'         =>  'Genre : ',
            'required'      =>  false,
            'filters'       =>  array('StripTags', 'StringTrim'),
            // 'attribs'       =>  array('size' => 50),
        ));

        // Un bouton d'envoi
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Sauvegarder',
        ));

        // Un bouton d'annulation
        $this->addElement('reset', 'reset', array(
            'ignore'   => true,
            'label'    => 'Annuler',
        ));

        // Et une protection anti CSRF
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

        $this->getElement("submit")->removeDecorator('DtDdWrapper') ;
        $this->getElement("csrf")->removeDecorator('label') ;

        $elements = array ("prenom", "nom", "courriel", "password", "adresse1", "adresse2", "codePostal", "ville", "estEmploye") ;

        foreach ($elements as $element) {
            $element = $this->getElement($element) ;
            if ($element!=null) {
                $element->removeDecorator('htmlTag');
            }
        }
    }


}
