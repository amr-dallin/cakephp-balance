<?php
App::uses('BalanceAppModel', 'Balance.Model');
App::uses('CakeTime', 'Utility');

/**
 * Currency Model
 *
 * @property Earning $Earning
 * @property Exchange $Exchange
 * @property Expense $Expense
 */
class Currency extends BalanceAppModel
{
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Earning' => array(
            'className' => 'Balance.Earning',
            'foreignKey' => 'currency_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Exchange' => array(
            'className' => 'Balance.Exchange',
            'foreignKey' => 'currency_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Exchange2' => array(
            'className' => 'Balance.Exchange',
            'foreignKey' => 'currency2_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Expense' => array(
            'className' => 'Balance.Expense',
            'foreignKey' => 'currency_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Discrepancy' => array(
            'className' => 'Balance.Discrepancy',
            'foreignKey' => 'currency_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    
    public function __construct()
    {
        parent::__construct();
        $this->validate = array(
            'title' => array(
                'notBlank' => array(
                    'rule' => array('notBlank'),
                    'message' => __('You must enter a title'),
                    'allowEmpty' => false,
                    'required' => true
                )
            ),
            'symbol' => array(
                'notBlank' => array(
                    'rule' => array('notBlank'),
                    'message' => __('You must enter a symbol'),
                    'allowEmpty' => false,
                    'required' => true
                )
            ),
            'codeIso' => array(
                'notBlank' => array(
                    'rule' => array('notBlank'),
                    'message' => __('You must enter a code ISO'),
                    'allowEmpty' => false,
                    'required' => true,
                    'last' => true
                )
            )
        );
    }

    public function balance()
    {
        $balance = array();
        $currencies = $this->find('all');

        foreach ($currencies as $k => $currency) {
            $balance[$k]['Currency'] = $currencies[$k]['Currency'];
            $balance[$k]['total'] = $this->calculation($currency);;
        }

        return $balance;
    }
    
    public function balanceByCurrency($id)
    {
        $currency = $this->findById($id);
        
        return $this->calculation($currency);
    }
    
    private function calculation($currency)
    {
        $totalEarning = 0;
        foreach ($currency['Earning'] as $earning) {
            $totalEarning += $earning['amount'];
        }

        $totalExchange2 = 0;
        foreach ($currency['Exchange2'] as $exchange2) {
            $totalExchange2 += $exchange2['amount2'];
        }

        $totalExpense = 0;
        foreach ($currency['Expense'] as $expense) {
            $totalExpense += $expense['amount'];
        }

        $totalExchange = 0;
        foreach ($currency['Exchange'] as $exchange) {
            $totalExchange += $exchange['amount'];
        }

        $totalDiscrepancy = 0;
        foreach ($currency['Discrepancy'] as $discrepancy) {
            $totalDiscrepancy += $discrepancy['amount'] - $discrepancy['balance'];
        }

        return $totalEarning + $totalExchange2 + $totalDiscrepancy - $totalExpense - $totalExchange;
    }
    
    public function statistics()
    {
        $currencies = $this->find('all', array('contain' => false));
        
        foreach ($currencies as $key => $currency) {
            
            $currencies[$key]['Total']['Earning'] = $this->Earning->totalAmount(
                $currency['Currency']['id']
            );
            
            $currencies[$key]['Total']['Expense'] = $this->Expense->totalAmount(
                $currency['Currency']['id']
            );
            
            if ($currencies[$key]['Total']['Earning'] == 0 &&
                $currencies[$key]['Total']['Expense']['total'] == 0
            ) {
                unset($currencies[$key]);
                continue;
            }
            
            $earnings = array();
            if ($currencies[$key]['Total']['Earning'] > 0) {
                $earnings = $this->Earning->totalAmountGroup(
                    $currency['Currency']['id']
                );
            }
            
            $expenses = array();
            $expensesExcess = array();
            if ($currencies[$key]['Total']['Expense']['total'] > 0) {
                $expenses = $this->Expense->totalAmountGroup(
                    $currency['Currency']['id'], null, false
                );
                
                $expensesExcess = $this->Expense->totalAmountGroup(
                    $currency['Currency']['id'], null, true
                );
            }
            if (!empty($earnings) || !empty($expenses) || !empty($expensesExcess)) {
                $currencies[$key]['Graph'] = $this->totalAmountGraph(
                    compact('earnings', 'expensesExcess', 'expenses')
                );
            }
        }
        
        return $currencies;
    }
}
