<?php
App::uses('BalanceAppController', 'Balance.Controller');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends BalanceAppController
{
    
    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Balance.Currency', 'Balance.Expense');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    /**
     * Displays a view
     *
     * @return void
     * @throws NotFoundException When the view file could not be found
     *   or MissingViewException in debug mode.
     */
    public function display()
    {
        $expensesCurrentMonth = $this->Expense->find('all', array(
            'conditions' => array(
                'MONTH(Expense.date_expense)' => CakeTime::format('m', time()),
                'YEAR(Expense.date_expense)' => CakeTime::format('Y', time())
            )
        ));

        $statistics = $this->Currency->statistics();
        
        $popularCategories = $this->Expense->populateCategories();
        
        $this->set(compact(
            'expensesCurrentMonth', 
            'statistics', 
            'popularCategories'
        ));
    }
}
