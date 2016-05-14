<?php

class Application_Form_ActeurRealisateur extends Zend_Form
{

    public function init()
    {
      $this->setName('acteurRealisateur');

      $id = new Zend_Form_Element_Hidden('id');
      $id->addFilter('Int');

      $genre = new Zend_Form_Element_Text('acteurRealisateur');
      $genre->setLabel('Genre')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

      $envoyer = new Zend_Form_Element_Submit('envoyer');
      $envoyer->setAttrib('id', 'boutonenvoyer');

      $this->addElements(array($id, $genre, $envoyer));
    }
    }


}
