<?php

class Application_Form_ActeurRealisateur extends Zend_Form
{
    
    public function init()
    {
        // La méthode HTTP d'envoi du formulaire
        $this->setMethod('post');

        // Un élément prénom
        $this->addElement('text', 'prenom', array(
              'label'         =>  'Prénom : ',
              'required'      =>  true,
              'filters'       =>  array('StripTags', 'StringTrim'),
              'validators'    =>  array(array('validator' =>  'NotEmpty',
                                                              'Alpha',
                                                              'options' => array('size' => '45'))),
                                                              /*'StringLength', true, 'options' => array(1, 45))),*/
        ));

        // Un élément nom
        $this->addElement('text', 'nom', array(
              'label'         =>  'Nom : ',
              'required'      =>  true,
              'filters'       =>  array('StripTags', 'StringTrim'),
              'validators'    =>  array(array('validator' =>  'NotEmpty',
                                                              'Alpha',
                                                              'options' => array('size' => '45'))),
                                                              /*'StringLength', true, 'options' => array(1, 45))),*/
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

        $elements = array ("prenom", "nom") ;

        foreach ($elements as $element) {
            $element = $this->getElement($element) ;
            if ($element!=null) {
                $element->removeDecorator('htmlTag');
            }
        }
    }
}
