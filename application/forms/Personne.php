<?php

class Application_Form_Personne extends Zend_Form
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

        // Un élément courriel
        $this->addElement('text', 'courriel', array(
            'label'         =>  'Adresse email : ',
            'required'      =>  true,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'validators'    =>  array(array('validator' =>    'NotEmpty',
                                                        'EmailAddress',))
                                                        // 'StringLength', true, 'options' => array(6,50))),
        ));

        // Un élément password
        $this->addElement('password', 'password', array(
            'label'         =>  'Mot de passe : ',
            'required'      =>  true,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'validators'    =>  array(array('validator' =>    'NotEmpty',))
                                                        // 'StringLength', true, 'options' => array(6, 12))),
        ));

        // Un élément addresse1
        $this->addElement('text', 'adresse1', array(
            'label'         =>  'Adresse principale : ',
            'required'      =>  false,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'validators'    =>  array(array('validator' =>    'NotEmpty',))
                                                        // 'StringLength', true, 'options' => array(0, 100))),
        ));

        // Un élément addresse2
        $this->addElement('text', 'adresse2', array(
            'label'         =>  'Suite de l\'adresse : ',
            'required'      =>  false,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'validators'    =>  array(array('validator' =>    'NotEmpty',))
                                                        // 'StringLength', true, 'options' => array(0, 100))),
        ));

        // Un élément code postal
        $this->addElement('text', 'codePostal', array(
            'label'         =>  'Code postal : ',
            'required'      =>  true,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'validators'    =>  array(array('validator' =>    'NotEmpty',
                                                                'options' => array(5, 5))),
                                                        // 'StringLength', true, 'options' => array(5, 5))),
        ));

        // Un élément ville
        $this->addElement('text', 'ville', array(
            'label'         =>  'Ville : ',
            'required'      =>  true,
            'filters'       =>  array('StripTags', 'StringTrim'),
            'validators'    =>  array(array('validator' =>    'NotEmpty',
                                                        'Alpha',))
                                                        // 'StringLength', true, 'options' => array(0, 100))),
        ));

        // Un élément estEmployé
        $this->addElement('checkbox', 'estEmploye', array(
            'label'             =>  'A cocher si la personne est un employé : ',
            'required'          =>  true,
            'checked_value'     =>  '1',
            'unchecked_value'   =>  '0'
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
