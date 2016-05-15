<?php

class Application_Form_Personne extends Zend_Form
{

    public function init()
    {
      $this->setName('personne');

      $id = new Zend_Form_Element_Hidden('id');
      $id->addFilter('Int');

      $nom = new Zend_Form_Element_Text('nom');
      $nom->setLabel('Nom : ')
          ->setRequired(true)
          ->addFilter('StripTags')
          ->addFilter('StringTrim')
          ->addValidator('Alpha')
          ->addValidator('NotEmpty');

      $prenom = new Zend_Form_Element_Text('prenom');
      $prenom->setLabel('Prénom : ')
             ->setRequired(true)
             ->addFilter('StripTags')
             ->addFilter('StringTrim')
             ->addValidator('Alpha')
             ->addValidator('NotEmpty');

      $password = new Zend_Form_Element_Password('motDePasse');
      $password->setLabel('Saisir le mot de passe : ')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->addValidator('StringLength', true, array(6,12));

      $courriel = new Zend_Form_Element_Text('courriel');
      $courriel->setLabel('Courriel : ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->addValidator('EmailAddress')
                ->addValidator('StringLength', true, array(6,50));

      $adresse1 = new Zend_Form_Element_Text('adresse1');
      $adresse1->setLabel('Adresse principale : ')
               ->setRequired(false)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('StringLength', true, array(0,100));

      $adresse2 = new Zend_Form_Element_Text('adresse2');
      $adresse2->setLabel('Suite de l\'adresse : ')
               ->setRequired(false)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('StringLength', true, array(0,100));

      $codePostal = new Zend_Form_Element_Text('code_postal');
      $codePostal->setLabel('Code postal : ')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', true, array(5,5));

      $ville = new Zend_Form_Element_Text('ville');
      $ville->setLabel('Ville : ')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('StringLength', true, array(1,50));

      $estEmploye = new Zend_Form_Element_Checkbox('estEmploye');
      $estEmploye->setLabel('La personne est un employé : ')
                 ->setRequired(true)
                 ->setCheckedValue('1')
                 ->setUncheckedValue('0');

      $envoyer = new Zend_Form_Element_Submit('envoyer');
      $envoyer->setAttrib('id', 'boutonenvoyer');

      $this->addElements(array($id, $nom, $prenom, $password, $courriel, $adresse1, $adresse2, $codePostal, $ville, $estEmploye, $envoyer));
    }

}
