<?php
App::uses('BalanceAppModel', 'Balance.Model');
/**
 * Exchange Model
 *
 * @property Currency $Currency
 * @property Currency2 $Currency2
 */
class Exchange extends BalanceAppModel
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
            'order' => ''
        ),
        'Currency2' => array(
            'className' => 'Currency',
            'foreignKey' => 'currency2_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
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
            'currency2_id' => array(
                'notBlank' => array(
                    'rule' => array('notBlank'),
                    'message' => __('You must select a currency'),
                    'allowEmpty' => false,
                    'required' => true
                )
            ),
            'amount2' => array(
                'decimal' => array(
                    'rule' => array('decimal'),
                    'message' => __('Please supply a valid amount'),
                    'allowEmpty' => false,
                    'required' => true
                )
            ),
        );
    }

}
