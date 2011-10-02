<?php
class M4e87e56622c84cf0a8357a753201ca43 extends CakeMigration {

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
					'ical_url' => 'http://www.google.com/calendar/ical/londontrash.ca_toihgjbglqo7fpng3mup7rk5kg%40group.calendar.google.com/public/basic.ics'
				),
				array(
					'id' => 9,
					'title' => 'dtw',
					'ical_url' => 'http://www.google.com/calendar/ical/londontrash.ca_dqk32j12rha39dkl64egagaego%40group.calendar.google.com/public/basic.ics'
				)
			);
			
			$this->Zone->saveAll($data);
		}
		return true;
	}
}
?>