<?php
class M4c9e6729dbc04c19bc68093b3201ca43 extends CakeMigration {

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

                if($direction == "up")
                {
                    $this->Zone = $this->generateModel("Zone");
                    $data = array(
                        array(
                            "id" => "1",
                            "title" => "A",
                            "ical_url" => "http://www.google.com/calendar/ical/p62ijvg5iab1i1vfv9vhbid7e8%40group.calendar.google.com/public/basic.ics"
                        ),
                        array(
                            "id" => "2",
                            "title" => "B",
                            "ical_url" => "http://www.google.com/calendar/ical/g4p6g1g9iqiboq1ki8e0p2hhmk%40group.calendar.google.com/public/basic.ics"
                        ),
                        array(
                            "id" => "3",
                            "title" => "C",
                            "ical_url" => "http://www.google.com/calendar/ical/eaob229p4dpln7s9n20led5o6s%40group.calendar.google.com/public/basic.ics"
                        ),
                        array(
                            "id" => "4",
                            "title" => "D",
                            "ical_url" => "http://www.google.com/calendar/ical/12qmb5b6oqhokrb3o1838u4lb8%40group.calendar.google.com/public/basic.ics"
                        ),
                        array(
                            "id" => "5",
                            "title" => "E",
                            "ical_url" => "http://www.google.com/calendar/ical/4h8m0v1arqoqu62esh2pqics98%40group.calendar.google.com/public/basic.ics"
                        ),
                        array(
                            "id" => "6",
                            "title" => "F",
                            "ical_url" => "http://www.google.com/calendar/ical/dt7ntti3a70a6ds38nomi0ea1k%40group.calendar.google.com/public/basic.ics"
                        ),
                        array(
                            "id" => "7",
                            "title" => "all",
                            "ical_url" => "http://www.google.com/calendar/ical/sufcc50sglm78jdngvhdatdlmk%40group.calendar.google.com/public/basic.ics"
                        )
                    );

                    $this->Zone->saveAll($data);
                    
                }
		return true;
	}
}
?>