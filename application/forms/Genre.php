<?php
class Application_Form_Genre extends Zend_Form
{
    // public function init()
    // {
    //   $this->setName('genre');
    //   $id = new Zend_Form_Element_Hidden('id');
    //   $id->addFilter('Int');
    //   $genre = new Zend_Form_Element_Text('genre');
    //   $genre->setLabel('Genre')
    //           ->setRequired(true)
    //           ->addFilter('StripTags')
    //           ->addFilter('StringTrim')
    //           ->addValidator('NotEmpty');
    //   $envoyer = new Zend_Form_Element_Submit('envoyer');
    //   $envoyer->setAttrib('id', 'boutonenvoyer');
    //   $this->addElements(array($id, $genre, $envoyer));
    // }
    //
    public function init()
    {
        // La méthode HTTP d'envoi du formulaire
        $this->setMethod('post');

        // Un élément Email
        $this->addElement('text', 'genre', array(
            'label'      => 'Genre :',
            'required'   => true,
            'filters'    => array('StripTags', 'StringTrim'),
            'validators' => array('validator' => 'NotEmpty')
        ));

        // Un bouton d'envoi
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Sauvegarder',
        ));

        // Et une protection anti CSRF
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}
