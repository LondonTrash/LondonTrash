<?php
class M4ca0b665571845f19b26827b3201ca43 extends CakeMigration {

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
			$this->Zone = $this->generateModel('Zone');
			
			$data = array(
				array(
					'id' => 8,
					'title' => 'dte',
					'ical_url' => 'http://www.google.com/calendar/ical/unlondon.ca_qug67chtf555ccuhj01m61fj9s%40group.calendar.google.com/public/basic.ics'
				),
				array(
					'id' => 9,
					'title' => 'dtw',
					'ical_url' => 'http://www.google.com/calendar/ical/unlondon.ca_nj97t6p1qghoohjb0352oqs570%40group.calendar.google.com/public/basic.ics'
				)
			);
			
			$this->Zone->saveAll($data);
		}
		return true;
	}
}
?>