<?php
class M50b295f732244ceba02382103201ca43 extends CakeMigration {

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
					'ical_url' => 'http://www.google.com/calendar/ical/vd6t952fpakmg91q556p5ekvpc@group.calendar.google.com/public/basic.ics'
				),
				array(
					'id' => 9,
					'title' => 'dtw',
					'ical_url' => 'http://www.google.com/calendar/ical/ars4r67b97l4mgn253jofeg6gg@group.calendar.google.com/public/basic.ics'
				)
			);

			$this->Zone->saveAll($data);
		}
		return true;
	}
}
?>
