<?php
class Application_Form_Genre extends Zend_Form
{

    public function init()
    {
        // La méthode HTTP d'envoi du formulaire
        $this->setMethod('post');

        // Un élément genre
        $this->addElement('text', 'genre', array(
            'label'      => 'Genre : ',
            'required'   => true,
            'filters'    => array('StripTags', 'StringTrim'),
            'validators' => array('validator' => 'NotEmpty')
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
    }
}
