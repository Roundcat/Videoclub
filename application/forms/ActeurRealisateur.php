<?php

class Application_Form_ActeurRealisateur extends Zend_Form
{
    public function init()
    {
      $this->setName('acteurRealisateur');

      $id = new Zend_Form_Element_Hidden('id');
      $id->addFilter('Int');

      $nom = new Zend_Form_Element_Text('nom');
      $nom->setLabel('Nom')
          ->setRequired(true)
          ->addFilter('StripTags')
          ->addFilter('StringTrim')
          ->addValidator('NotEmpty');

      $prenom = new Zend_Form_Element_Text('prenom');
      $prenom->setLabel('Prénom')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addFilter('StringTrim')
             ->addValidator('NotEmpty');

      $envoyer = new Zend_Form_Element_Submit('envoyer');
      $envoyer->setAttrib('id', 'boutonenvoyer');

      $this->addElements(array($id, $nom, $prenom, $envoyer));
    }
}
