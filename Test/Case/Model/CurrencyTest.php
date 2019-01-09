<?php
App::uses('Currency', 'Balance.Model');

/**
 * Currency Test Case
 */
class CurrencyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.balance.currency',
		'plugin.balance.discrepancy',
		'plugin.balance.earning',
		'plugin.balance.exchange',
		'plugin.balance.expense'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Currency = ClassRegistry::init('Balance.Currency');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Currency);

		parent::tearDown();
	}

}
