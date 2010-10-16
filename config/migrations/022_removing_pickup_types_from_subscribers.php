<?php
class M4cb9d06d82dc48c39a7053e23201ca43 extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'drop_field' => array(
				'subscribers' => array('weekly', 'special',),
			),
		),
		'down' => array(
			'create_field' => array(
				'subscribers' => array(
					'weekly' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
					'special' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
				),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
?>