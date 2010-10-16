<?php
class M4ca2d46fb9484620bb09428f3201ca43 extends CakeMigration {

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
			'create_field' => array(
				'zones' => array(
					'formatted_title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'zones' => array('formatted_title',),
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
		if ($direction == 'up') {
			$this->Zone = $this->generateModel('Zone');
			
			$data = array(
				array(
					'id' => 1,
					'formatted_title' => 'Zone A'
				),
				array(
					'id' => 2,
					'formatted_title' => 'Zone B'
				),
				array(
					'id' => 3,
					'formatted_title' => 'Zone C'
				),
				array(
					'id' => 4,
					'formatted_title' => 'Zone D'
				),
				array(
					'id' => 5,
					'formatted_title' => 'Zone E'
				),
				array(
					'id' => 6,
					'formatted_title' => 'Zone F'
				),
				array(
					'id' => 7,
					'formatted_title' => 'All Zones'
				),
				array(
					'id' => 8,
					'formatted_title' => 'Downtown E'
				),
				array(
					'id' => 9,
					'formatted_title' => 'Downtown W'
				),
			);
			
			$this->Zone->saveAll($data);
		}
		return true;
	}
}
?>