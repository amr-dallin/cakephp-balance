<?php
App::uses('BalanceAppModel', 'Balance.Model');
/**
 * Category Model
 *
 * @property Category $ParentCategory
 * @property Category $ChildCategory
 * @property Expense $Expense
 */
class Category extends BalanceAppModel
{
    /**
     * Behaviors
     *
     * @var array
     */
    public $actsAs = array('Tree');

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'ParentCategory' => array(
            'className' => 'Balance.Category',
            'foreignKey' => 'parent_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'ChildCategory' => array(
            'className' => 'Balance.Category',
            'foreignKey' => 'parent_id',
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
            'foreignKey' => 'category_id',
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
                    'required' => false
                )
            )
        );
    }
    
    public function statisticsGraph($id)
    {
        $children = $this->children($id, false, array('id'));
        
        $category_ids = array($id);
        foreach($children as $child) {
            $category_ids[] = $child['Category']['id'];
        }
        
        return $this->Expense->statisticsGraph($category_ids);
    }
}
