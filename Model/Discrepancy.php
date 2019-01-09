<?php
App::uses('BalanceAppModel', 'Balance.Model');
/**
 * Discrepancy Model
 *
 * @property Currency $Currency
 */
class Discrepancy extends BalanceAppModel
{
    // The Associations below have been created with all possible keys, those that are not needed can be removed

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
            'order' => array('Discrepancy.created' => 'DESC')
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
            )
        );
    }
    
    public function beforeSave($options = array())
    {
        $this->data[$this->alias]['balance'] = $this->Currency->balanceByCurrency(
            $this->data[$this->alias]['currency_id']
        );
        
        return true;
    }

}
