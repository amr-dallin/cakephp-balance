<?php
App::uses('AppModel', 'Model');
App::uses('CakeTime', 'Utility');
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class BalanceAppModel extends AppModel
{
	var $actsAs = array('Containable');
    
    public function totalAmountGraph($total)
    {   
        $dateInterval = $this->dateInterval($total);
        
        if (empty($dateInterval)) {
            return false;
        }
        
        $result = array(
            'labels' => json_encode($dateInterval)
        );
        $data = array();
        foreach ($total as $type => $total_type) {
            if (empty($total_type)) {
                continue;
            }

            foreach ($dateInterval as $key => $date) {

                $data[$type][$key] = 0;
                foreach ($total_type as $amount_month) {
                    if ($date == $amount_month[0]['date']) {
                        $data[$type][$key] = $amount_month[0]['amount'];
                        continue(2);
                    }
                }
            }
            
            switch($type) {
                case 'expenses':
                    $stack = 'Stack 1';
                    $backgroundColor = '#20a8d8';
                    break;
                case 'expensesExcess':
                    $stack = 'Stack 1';
                    $backgroundColor = '#f86c6b';
                    break;
                case 'earnings':
                    $stack = 'Stack 0';
                    $backgroundColor = '#4dbd74';
                    break;
                
            }
            
            $datasets[] = array(
                'stack' => $stack,
                'backgroundColor' => $backgroundColor,
                'label' => $type,
                'data' => $data[$type]
            );
        }

        return array(
            'labels' => json_encode($dateInterval),
            'datasets' => json_encode($datasets)
        );
    }
    
    private function dateInterval($total)
    {
        $type = array_keys($total);
        
        $min_date = null;
        for ($i = 0; $i < count($type); $i++) {
            if (empty($total[$type[$i]])) {
                continue;
            }
            
            $date = CakeTime::fromString($total[$type[$i]][0][0]['date']);
            
            if (empty($min_date)) {
                $min_date = $date;
                continue;
            }
            
            if ($min_date > $date) {
                $min_date = $date;
            }
        }
        
        if (empty($min_date)) {
            return false;
        }
        
        $daterange = new \DatePeriod(
            new \DateTime(date('F Y', $min_date)),
            new \DateInterval('P1M'),
            new \DateTime(date('F Y'))
        );

        $dateInterval = null;
        foreach ($daterange as $date) {
            $dateInterval[] = $date->format("F Y");
        }
        $dateInterval[] = date('F Y');
        
        return $dateInterval;
    }
}
