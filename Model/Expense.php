<?php
App::uses('BalanceAppModel', 'Balance.Model');
App::uses('CakeTime', 'Utility');

/**
 * Expense Model
 *
 * @property Category $Category
 */
class Expense extends BalanceAppModel
{
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Category' => array(
            'className' => 'Balance.Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Currency' => array(
            'className' => 'Balance.Currency',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'fields' => '',
            'order' => array('Expense.date_expense' => 'DESC')
        )
    );

    public function __construct()
    {
        parent::__construct();
        $this->validate = array(
            'category_id' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __('Please supply the number of category'),
                    'allowEmpty' => true,
                    'required' => true
                ),
            ),
            'currency_id' => array(
                'notBlank' => array(
                    'rule' => array('notBlank'),
                    'message' => __('You must select a currency'),
                    'allowEmpty' => false,
                    'required' => true
                ),
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => __('You must select a currency'),
                    'allowEmpty' => false,
                    'required' => true
                ),
            ),
            'amount' => array(
                'notBlank' => array(
                    'rule' => array('notBlank'),
                    'message' => __('You must enter a amount'),
                    'allowEmpty' => false,
                    'required' => true
                ),
                'decimal' => array(
                    'rule' => array('decimal'),
                    'message' => __('Please supply a valid amount'),
                    'allowEmpty' => false,
                    'required' => true
                )
            ),
            'date_expense' => array(
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
        $this->data['Expense']['date_expense'] = CakeTime::format(
            'Y-m-d', 
            $this->data['Expense']['date_expense']
        );
        
        return true;
    }

    public function statisticsGraph($categories = null)
    {
        $currencies = $this->Currency->find('all', array('contain' => false));

        foreach ($currencies as $key => $currency) {
            $currencies[$key]['Total']['Expense'] = $this->totalAmount(
                $currency['Currency']['id'],
                $categories
            );

            if ($currencies[$key]['Total']['Expense']['total'] == 0) {
                unset($currencies[$key]);
                continue;
            }
            
            $expenses = $this->totalAmountGroup(
                $currency['Currency']['id'], $categories, false
            );
            
            $expensesExcess = $this->totalAmountGroup(
                $currency['Currency']['id'], $categories, true
            );
            
            $currencies[$key]['Graph'] = $this->totalAmountGraph(compact(
                'expensesExcess', 'expenses'
            ));
        }

        return array_values($currencies);
    }
    
    public function totalAmount($currency_id, $categories = null, $month = null)
    {
        $total = $this->totalAmountExcess($currency_id, $categories, $month);

        $totalExcess = $this->totalAmountExcess(
            $currency_id, 
            $categories, 
            $month, 
            true
        );
        
        return array('total' => $total, 'excess' => $totalExcess);
    }
    
    private function totalAmountExcess($currency_id, $categories = null, $month = null, $excess = null)
    {
        if (null !== $excess) {
            $excess = array('Expense.excess' => $excess);
        }
        
        if (null !== $categories) {
            $categories = array('Expense.category_id' => $categories);
        }
        
        if (null !== $month) {
            $month = array('MONTH(Expense.date_expense)' => $month);
        }
        
        $total = $this->find('all', array(
            'conditions' => array(
                'Expense.currency_id' => $currency_id,
                $categories,
                $month,
                $excess
            ),
            'fields' => array('SUM(Expense.amount) as amount')
        ));
        
        if (!empty($total[0][0]['amount'])) {
            return $total[0][0]['amount'];
        }
        
        return 0;
    }
    
    public function totalAmountGroup($currency_id, $categories = null, $excess = null)
    {
        if (null !== $excess) {
            $excess = array('Expense.excess' => $excess);
        }
        
        if (null !== $categories) {
            $categories = array('Expense.category_id' => $categories);
        }
        
        return $this->find('all', array(
            'conditions' => array(
                'Expense.currency_id' => $currency_id,
                $categories,
                $excess
            ),
            'order' => array('Expense.date_expense' => 'ASC'),
            'fields' => array(
                'SUM(Expense.amount) as amount',
                'DATE_FORMAT(Expense.date_expense, "%M %Y") as date',
            ),
            'group' => array('MONTH(Expense.date_expense)')
        ));
    }
    
    public function populateCategories()
    {
        $categories = $this->find('all', array(
            'fields' => array(
                'COUNT(Expense.id) as count',
                'Category.title'
            ),
            'order' => array('count' => 'DESC'),
            'group' => array('Expense.category_id'),
            'contain' => array('Category'),
            'limit' => 6
        ));
        
        $labels = array();
        $data = array();
        foreach($categories as $key => $category) {
            $labels[$key] = $category['Category']['title'];
            $data[$key] = $category[0]['count'];
        }
        
        if (!empty($data) && !empty($labels)) {
            return array(
                'labels' => json_encode($labels),
                'data' => json_encode($data)
            );
        }
        
        return false;
    }
    
    public function wastefulCategories($currency_id)
    {
        return $this->find('all', array(
            'conditions' => array('Expense.currency_id' => $currency_id),
            'fields' => array(
                'SUM(Expense.amount) as amount',
                'Category.title',
                'Currency.title'
            ),
            'order' => array('amount' => 'DESC'),
            'group' => array('Expense.category_id'),
            'contain' => array('Category', 'Currency'),
            'limit' => 6
        ));
    }
    
}
