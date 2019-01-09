<?php

/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppHelper', 'View/Helper');
/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class BalanceHelper extends AppHelper
{
    var $helpers = array('Html', 'Form', 'Time');

    public function dateFormat($format, $date)
    {
        if (!empty($date) && !empty($format)) {
            return $this->Time->format($format, $date);
        }
        
        return false;
    }
    
	public function countFieldset()
    {
		$count = 1;
        
        if (!isset($this->params['pass'][0])) {
            return $count;
        }
        
        $pass = $this->params['pass'][0];
		if ($pass > 1 && $pass < 20) {
			$count = $pass;
		}
		
		return $count;
	}
    
    public function breadcrumbsCategory($id, $getPath)
    {
        $breadcrumbs[] = array(
            'title' => __('Categories'),
            'url' => array('action' => 'index')
        );
        foreach ($getPath as $path) {
            $url = array();
            if ($path['Category']['id'] != $this->request->params['pass'][0]) {
                $url = array($path['Category']['id']);
            }

            $breadcrumbs[] = array(
                'title' => $path['Category']['title'],
                'url' => $url
            );
        }
        
        return $breadcrumbs;
    }

}
