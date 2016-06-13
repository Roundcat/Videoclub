<?php

class Application_Form_Location extends Zend_Form
{

    public function init()
    {
        // La méthode HTTP d'envoi du formulaire
        $this->setMethod('post');

        // Un élément personne
        $this->addElement('select', 'PersonneId', array(
            'label'         =>  'Client : ',
            'required'      =>  true,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'attribs'       =>  array('style' => 'width: 150px'),
            'validators'    =>  array(array('validator' => 'NotEmpty'))
        ));

        // Un élément date_retour
        $this->addElement('text', 'DateRetour', array(
            'label'         =>  'Date de retour de la location : ',
            'required'      =>  false,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'attribs'       =>  array('size' => 20),
            'validators'    =>  array(array('validator' =>  'NotEmpty',
                                                            'Date'))
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

        $elements = array ("Personne_id", "media_id", "date_retour") ;

        foreach ($elements as $element) {
            $element = $this->getElement($element) ;
            if ($element!=null) {
                $element->removeDecorator('htmlTag');
            }
        }
    }

}
