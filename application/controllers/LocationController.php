<?php

class LocationController extends Zend_Controller_Action
{

    protected $_flashMessenger = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->_flashMessenger = $this->_helper
                                      ->getHelper('FlashMessenger');
        $this->initView();
    }

    public function indexAction()
    {
        // action body
    }

    public function saisirSortieAction()
    {
        // action body
    }

    public function saisirRetourAction()
    {
        // action body
    }

    public function listeSortieAction()
    {
        // action body
    }


}
