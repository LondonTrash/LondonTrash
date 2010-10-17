<?php
class M4ca7f61c0fbc49e5998772b33201ca43 extends CakeMigration {

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
		),
		'down' => array(
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
			// save preset Protocols
			$this->Protocol = $this->generateModel('Protocol');
			
			$protocols = array(
				array(
					'id' => 1,
					'title' => 'Email',
				),
				array(
					'id' => 2,
					'title' => 'SMS'
				)
			);
			
			$this->Protocol->saveAll($protocols);
			
			// save preset Providers
			$this->Provider = $this->generateModel('Provider');
			
			$providers = array(
				array(
					'id' => 1,
					'title' => 'Email',
					'protocol_id' => 1
				),
				array(
					'id' => 2,
					'title' => 'Rogers',
					'protocol_id' => 2,
					'template' => 'pcs.rogers.com'
				),
				array(
					'id' => 3,
					'title' => 'Fido',
					'protocol_id' => 2,
					'template' => 'fido.ca'
				),
				array(
					'id' => 4,
					'title' => 'Telus',
					'protocol_id' => 2,
					'template' => 'msg.telus.com'
				),
				array(
					'id' => 5,
					'title' => 'Bell',
					'protocol_id' => 2,
					'template' => 'txt.bell.ca'
				),
				array(
					'id' => 6,
					'title' => 'Koodo',
					'protocol_id' => 2,
					'template' => 'msg.koodomobile.com'
				),
				array(
					'id' => 7,
					'title' => "President's Choice",
					'protocol_id' => 2,
					'template' => 'txt.bell.ca'
				),
				array(
					'id' => 8,
					'title' => 'Solo',
					'protocol_id' => 2,
					'template' => 'txt.bell.ca'
				),
				array(
					'id' => 9,
					'title' => 'Virgin',
					'protocol_id' => 2,
					'template' => 'vmobile.ca'
				),
			);
			
			$this->Provider->saveAll($providers);
		}
		return true;
	}
}
?>