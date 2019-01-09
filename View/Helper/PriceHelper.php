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
class PriceHelper extends AppHelper
{

    var $helpers = array('Html');

    public function currency($price, $currency)
    {
        $price = number_format($price, 0, '.', '');
        if ($currency == '$') {
            $price = '$' . $price;
        } else {
            $price = $price . ' ' . $currency;
        }

        return $price;
    }
    
    public function difference($amount, $balance, $currency)
    {
        $difference = $amount - $balance;
        
        $textClassColor = 'text-danger';
        if ($difference > 0) {
            $textClassColor = 'text-success';
        }
        
        return $this->Html->tag('span',
            $this->currency($difference, $currency),
            array('class' => $textClassColor)
        );
    }
    
    public function exchangeRate($amount, $amount2)
    {
        if ($amount > $amount2) {
            $division = round($amount / $amount2, 2);
            $rate = '1 : ' . $division;
        } else {
            $division = round($amount2 / $amount, 2);
            $rate = $division . ' : 1';
        }
        
        return $rate;
    }
}
