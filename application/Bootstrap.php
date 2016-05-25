<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initDb()
    {
         $db = new Zend_Db_Adapter_Pdo_Mysql(
            array(
                'host' => 'localhost',
                'username' => 'dev',
                'password' => '',
                'dbname' => 'videoclub'
            )
        );
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
        Zend_Registry::set('db', $db);
    }

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

}
