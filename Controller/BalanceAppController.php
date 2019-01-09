<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeTime', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class BalanceAppController extends AppController
{
    public $components = array(
        'Flash',
        'RequestHandler'
    );

    public function beforeFilter()
    {
        $this->__setSettings();
        //$this->theme = 'SmartAdmin';
    }

    private function __setSettings()
    {
        $Currency = ClassRegistry::init('Balance.Currency');
        $currencies = $Currency->find('list', array(
            'fields' => array('id', 'codeIso')
        ));
        
        Configure::write('Currencies', $currencies);
    }
}
