<?php
App::uses('BalanceAppModel', 'Balance.Model');
App::uses('CakeTime', 'Utility');

/**
 * Earning Model
 *
 */
class Earning extends BalanceAppModel
{
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'fields' => '',
            'order' => array('Earning.date_earning' => 'DESC')
        )
    );

    public function __construct()
    {
        parent::__construct();
        $this->validate = array(
            'currency_id' => array(
                'notBlank' => array(
                    'rule' => array('notBlank'),
                    'message' => __('You must select a currency'),
                    'allowEmpty' => false,
                    'required' => true
                )
            ),
            'amount' => array(
                'decimal' => array(
                    'rule' => array('decimal'),
                    'message' => __('Please supply a valid amount'),
                    'allowEmpty' => false,
                    'required' => true
                )
            ),
            'date_earning' => array(
                'date' => array(
                    'rule' => array('date', 'dMy'),
                    'message' => __('Enter a valid date in DD MM YYYY format.'),
                    'allowEmpty' => false,
                    'required' => true
                )
            ),
        );
    }

    public function beforeSave($options = array())
    {
        $this->data['Earning']['date_earning'] = CakeTime::format('Y-m-d', 
            $this->data['Earning']['date_earning']
        );

        return true;
    }

    public function statisticsGraph()
    {
        $currencies = $this->Currency->find('all', array('contain' => false));

        foreach ($currencies as $key => $currency) {
            $currencies[$key]['Total']['Earning'] = $this->totalAmount(
                $currency['Currency']['id']
            );

            if ($currencies[$key]['Total']['Earning'] == 0) {
                unset($currencies[$key]);
                continue;
            }
            
            $earnings = $this->totalAmountGroup($currency['Currency']['id']);

            $currencies[$key]['Graph'] = $this->totalAmountGraph(
                compact('earnings')
            );
        }

        return $currencies;
    }
    
    public function totalAmount($currency_id, $month = null)
    {
        if (null !== $month) {
            $month = array('MONTH(Expense.date_expense)' => $month);
        }
        
        $total = $this->find('all', array(
            'conditions' => array(
                'Earning.currency_id' => $currency_id,
                $month
            ),
            'order' => array('Earning.date_earning' => 'DESC'),
            'fields' => array('SUM(Earning.amount) as amount')
        ));
        
        if (!empty($total[0][0]['amount'])) {
            return $total[0][0]['amount'];
        }
        
        return 0;
    }
    
    public function totalAmountGroup($currency_id)
    {
        return $this->find('all', array(
            'conditions' => array('Earning.currency_id' => $currency_id),
            'fields' => array(
                'SUM(Earning.amount) as amount',
                'DATE_FORMAT(Earning.date_earning, "%M %Y") as date',
            ),
            'contain' => array(),
            'group' => array('date'),
            'order' => array('date' => 'ASC')
        ));
    }
}
