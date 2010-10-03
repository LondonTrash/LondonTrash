<?php
class M4ca14d4da44c47dba918bc173201ca43 extends CakeMigration {

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
			$this->Content = $this->generateModel('Content');
			
$pages = array(
array(  
	'id' => 1,
	'slug' => 'missed-collections',
	'title' => "Missed Collections",
	'body' => 
<<<HTML
Your garbage may not be collected for a number reasons including:

<ul>

	<li>The container or bag weighed more than 20 kg (44 lbs).</li>

	<li>The container or bag had yard materials or other non-collectable items inside.</li>

	<li>The container or bag was more than 125 litres (28 Imperial gallons).</li>

	<li>The garbage was set out on a snow bank.</li>

	<li>The garbage was placed inside an unlabeled cardboard box or small plastic bags.</li>

	<li>The garbage was not at the curb by 7 AM for collection.</li>

	<li>The lid was tied onto the reusable container.</li>

	<li>The garbage was not placed on the curb (it was on private property).</li>

</ul>
HTML
,
	'category' => 'pages'
),
array(
	'id' => 2,
	'slug' => 'garbage-safety',
	'title' => "Garbage Safety",
	'body' => 
<<<HTML
<div>

<ul>

	<li><strong>DO NOT</strong> place needles in the garbage. Place them in a hard plastic container and contact your local pharmacy, the Middlesex London Health Unit (519-663-5317, or <a href="http://www.healthunit.com">www.healthunit.com</a>), or visit <a href="http://www.dowhatyoucan.ca">www.dowhatyoucan.ca</a> for safe disposal information. </li> 

	<li>Put broken glass and sharp metal objects in a sealed and clearly labeled cardboard box for garbage collectors. This will contain the glass if it breaks at collection.</li>

	<li>Remove bungee cords and straps from container lids. These can snap back and hit collectors, catch on their clothing or the truck.</li>

	<li>Ensure that animal waste and cat litter are free of liquid and double-bagged for garbage collection.</li>

</ul>

</div>
HTML
,
	'category' => 'pages'
),
array(
	'id' => 3,
	'slug' => 'recycling-don-ts',
	'title' => "Recycling - Don'ts",
	'body' => 
<<<HTML
<div>

<em><strong>DON'T:</strong></em>

<br/><br/>

The following <strong>DO NOT</strong> belong in your Blue Box:

<ul>

	<li>Bakery/food trays and clamshell containers. <em>(Why don't we recycle them?  Not all plastic has a recycling market or end user. Clamshell containers, bakery and food trays and plastic pots are light, thin-walled plastic that adversely affects the manufacturing of the end products by creating imperfections, bubbles and weak spots in the products. They have a different chemical makeup and melting point compared with a #1 plastic food or beverage bottle, even though they are all labelled #1 or PET or PETE. Hopefully market conditions will change in the near future.)</em></li>

	<li>Plastic plant pots.</li>

	<li>StyrofoamÂ™ containers (foam containers like coffee cups, egg cartons and protective foam packaging).</li>

	<li>Waxed boxboard (such as frozen food packaging).</li>

	<li>Shredded paper - place in clear or translucent plastic bag for recycling collection, not loose in Blue Box.</li>

</ul>

</div>
HTML
,
	'category' => 'pages'
),
array(
	'id' => 4,
	'slug' => 'garbage',
	'title' => "Garbage",
	'body' => 
<<<HTML
<div>

<em><strong>DO:</strong></em>

<ul>

	<li>Put your garbage at the curb by 7 A.M. the day of garbage pickup, but no earlier than 6 P.M. the night before.</li>

	<li>Use plastic garbage bags, metal or plastic cans (minimum 30L, maximum 125L). Maximum weight for bags or cans is 20kg (44lbs.).</li>

	<li>We <strong>DO</strong> take large items like couches, mattresses, furniture and carpet cut to 1m (39") lengths tied in bundles. Remove mattresses from hideaway beds and tie springs down. Remove the tank from two-piece toilets and empty water.</li>

	<li>Dog feces and cat litter must be bagged, free of liquids and placed inside a larger bag.</li>

	<li>Bagged garbage is accepted at depots for a fee.</li>

</ul>



<em><strong>DON'T:</strong></em>

<ul>

	<li>Don't place small grocery or kitchen bags at the curb. They will not be picked up unless placed in garbage cans or larger bags.</li>

	<li>The following materials will <strong>NOT</strong> be collected at the curb: scrap metal (propane tanks, barbecues, bike frames, car parts, etc.), construction and renovation materials (drywall, wood, etc.), appliances (fridges, stoves, etc.), electronics (TVs, monitors, computers, etc.), tires, and compact fluorescent light bulbs / tubes.</li>

	<li>Don't place garbage at the curbside outside of the specified hours.</li>

	<li>Don't place needles in the garbage. Place them in a hard plastic container and contact your local pharmacy or visit <a href=www.healthunit.com>www.healthunit.com</a> or <a href=www.dowhatyoucan.ca>www.dowhatyoucan.ca</a> for safe disposal information.</li>

	<li>Don't put broken glass and sharp metal objects in regular garbage. Place them in a sealed and clearly labeled cardboard box for garbage collectors. This will contain the glass if it breaks at collection.</li>

</ul>

</div>
HTML
,
	'category' => 'pages'
),
array(
	'id' => 5,
	'slug' => 'yard-materials',
	'title' => "Yard Materials",
	'body' => 
<<<HTML
<div>

<em><strong>DO:</strong></em>

<ul>

	<li>Place plant trimmings, brush, leaves and pumpkins in kraft paper bags, garbage cans or certified compostable bags. <strong>NO</strong> grass clippings. Certified compostable bags have one of the following images on it:<br/><br/>

	<img src="Certified_Compostable_Cdn_Logo.jpg">&nbsp;&nbsp;&nbsp;<img src="Certified_Compostable_US_Logo1.jpg"></li>

	<li>Cut brush to a length of less than 1m (39") and tie it in bundles with string or rope. Limbs must be less than 10cm (4") in diameter.</li>

	<li>Place fall leaves and yard materials 1.5m (5') from regular garbage by 7 A.M. on Monday of the designated week. It may be collected any time during the week, including Saturdays.</li>

</ul>



<em><strong>DON'T:</strong></em>

<ul>

	<li>Don't use regular plastic bags for yard materials.</li>

	<li>We <strong>DO NOT</strong> accept:</li>

	<ul>

		<li>Grass clippings.</li>

		<li>Sod.</li>

		<li>Dirt/soil.</li>

		<li>Rocks.</li>

		<li>Large branches (greater than 10cm / 4" in diameter).</li>

		<li>Tree stumps.</li>

		<li>Railway ties.</li>

		<li>Painted and treated wood.</li>

		<li>Flower pots/trays.</li>

		<li>Kitchen food scraps.</li>

		<li>Animal waste.</li>

	</ul>

</ul>

</div>
HTML
,
	'category' => 'pages'
),
array(
	'id' => 6,
	'slug' => 'garbage-collection-general-info',
	'title' => "Garbage Collection - General Info",
	'body' => 
<<<HTML
<div>
<ul>

	<li>Containers can be garbage bags or cans (minimum 30 L, maximum 125 L); maximum weight is 20 kg (44 lbs.).</li>

	<li>There is no limit to the number of bulky items set out on collection day. These include furniture, mattresses, carpet (1m / 39" lengths, tied in bundles), etc., but do not include non-collectables such as scrap metal, appliances, construction and renovation materials.</li>

	<li>A maximum of up to 4 containers per collection is allowed.  The container limit applies to each registered residential unit. For example, a duplex is allowed 8 bags, a triplex is allowed 12 bags, and a multi-unit townhome complex is allowed 4 containers for each unit.</li>

	<li>Extra garbage?  There are three depot locations where extra garbage can be taken (fees apply). Information about depot locations and hours can be found at <a href="http://www.london.ca">www.london.ca</a> or by calling 519-661-4585. In addition, there are two collection days per year when the container limit will not be enforced:</li>

	<ul>

		<li>The first collection following Christmas (December 25th).</li>

		<li>Spring collection in late April/early May.</li>

	</ul>

</ul>

</div>
HTML
,
	'category' => 'pages'
	)
);
$this->Content->saveAll($pages);

$tips = array(
array(
	'id' => 7,
	'body' => 
<<<HTML
<strong>DO NOT</strong> place needles in the garbage. Place them in a hard plastic container and contact your local pharmacy, the Middlesex London Health Unit (519-663-5317, or <a href="http://www.healthunit.com">www.healthunit.com</a>), or visit <a href="http://www.dowhatyoucan.ca">www.dowhatyoucan.ca</a> for safe disposal information.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 8,
	'body' => 
<<<HTML
Put broken glass and sharp metal objects in a sealed and clearly labeled cardboard box for garbage collectors. This will contain the glass if it breaks at collection.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 9,
	'body' => 
<<<HTML
Remove bungee cords and straps from container lids. These can snap back and hit collectors, catch on their clothing or the truck.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 10,
	'body' => 
<<<HTML
Ensure that animal waste and cat litter are free of liquid and double-bagged for garbage collection.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 11,
	'body' => 
<<<HTML
Your garbage may not be collected if the container or bag weighs more than 20 kg (44 lbs).
HTML
,
	'category' => 'tips'
),
array(
	'id' => 12,
	'body' => 
<<<HTML
Your garbage may not be collected if the container or bag has yard materials or other non-collectable items inside.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 13,
	'body' => 
<<<HTML
Your garbage may not be collected if the container or bag is more than 125 litres (28 Imperial gallons).
HTML
,
	'category' => 'tips'
),
array(
	'id' => 14,
	'body' => 
<<<HTML
Your garbage may not be collected if the garbage is set out on a snow bank.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 15,
	'body' => 
<<<HTML
Your garbage may not be collected if the garbage is placed inside an unlabeled cardboard box or small plastic bags.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 16,
	'body' => 
<<<HTML
Your garbage may not be collected if the garbage is not at the curb by 7 AM for collection.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 17,
	'body' => 
<<<HTML
Your garbage may not be collected if the lid is tied onto the reusable container.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 18,
	'body' => 
<<<HTML
Your garbage may not be collected if the garbage is not placed on the curb (on private property).
HTML
,
	'category' => 'tips'
),
array(
	'id' => 19,
	'body' => 
<<<HTML
Bakery/food trays and clamshell containers <strong>DO NOT</strong> belong in your Blue Box.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 20,
	'body' => 
<<<HTML
Plastic plant pots <strong>DO NOT</strong> belong in your Blue Box.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 21,
	'body' => 
<<<HTML
Styrofoam&trade; containers (foam containers like coffee cups, egg cartons and protective foam packaging) <strong>DO NOT</strong> belong in your Blue Box.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 22,
	'body' => 
<<<HTML
Waxed boxboard (such as frozen food packaging) <strong>DOES NOT</strong> belong in your Blue Box.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 23,
	'body' => 
<<<HTML
Shredded paper <strong>DOES NOT</strong> belong loose in your Blue Box - place in clear or translucent plastic bag for recycling collection.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 24,
	'body' => 
<<<HTML
Put your garbage at the curb by 7 A.M. the day of garbage pickup, but no earlier than 6 P.M. the night before.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 25,
	'body' => 
<<<HTML
Use plastic garbage bags, metal or plastic cans (minimum 30L, maximum 125L). Maximum weight for bags or cans is 20kg (44lbs.).
HTML
,
	'category' => 'tips'
),
array(
	'id' => 26,
	'body' => 
<<<HTML
We <strong>DO</strong> take large items like couches, mattresses, furniture and carpet cut to 1m (39") lengths tied in bundles. Remove mattresses from hideaway beds and tie springs down. Remove the tank from two-piece toilets and empty water.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 27,
	'body' => 
<<<HTML
Dog feces and cat litter must be bagged, free of liquids and placed inside a larger bag.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 28,
	'body' => 
<<<HTML
Bagged garbage is accepted at depots for a fee.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 29,
	'body' => 
<<<HTML
Don't place small grocery or kitchen bags at the curb. They will not be picked up unless placed in garbage cans or larger bags.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 30,
	'body' => 
<<<HTML
The following materials will <strong>NOT</strong> be collected at the curb: scrap metal (propane tanks, barbecues, bike frames, car parts, etc.), construction and renovation materials (drywall, wood, etc.), appliances (fridges, stoves, etc.), electronics (TVs, monitors, computers, etc.), tires, and compact fluorescent light bulbs / tubes.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 31,
	'body' => 
<<<HTML
Don't place garbage at the curbside outside of the specified hours.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 32,
	'body' => 
<<<HTML
Don't place needles in the garbage. Place them in a hard plastic container and contact your local pharmacy or visit <a href=www.healthunit.com>www.healthunit.com</a> or <a href=www.dowhatyoucan.ca>www.dowhatyoucan.ca</a> for safe disposal information.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 33,
	'body' => 
<<<HTML
Don't put broken glass and sharp metal objects in regular garbage. Place them in a sealed and clearly labeled cardboard box for garbage collectors. This will contain the glass if it breaks at collection.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 34,
	'body' => 
<<<HTML
Yard Waste - Place plant trimmings, brush, leaves and pumpkins in kraft paper bags, garbage cans or certified compostable bags. <strong>NO</strong> grass clippings.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 35,
	'body' => 
<<<HTML
Yard Waste - Cut brush to a length of less than 1m (39") and tie it in bundles with string or rope. Limbs must be less than 10cm (4") in diameter.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 36,
	'body' => 
<<<HTML
Yard Waste - Place fall leaves and yard materials 1.5m (5') from regular garbage by 7 A.M. on Monday of the designated week. It may be collected any time during the week, including Saturdays.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 37,
	'body' => 
<<<HTML
Yard Waste - Don't use regular plastic bags for yard materials.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 38,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept grass clippings.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 39,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept sod.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 40,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept dirt/soil.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 41,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept rocks.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 42,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept large branches (greater than 10cm / 4" in diameter).
HTML
,
	'category' => 'tips'
),
array(
	'id' => 43,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept tree stumps.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 44,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept railway ties.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 45,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept painted and treated wood.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 46,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept flower pots/trays.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 47,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept kitchen food scraps.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 48,
	'body' => 
<<<HTML
Yard Waste - We <strong>DO NOT</strong> accept animal waste.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 49,
	'body' => 
<<<HTML
Containers can be garbage bags or cans (minimum 30 L, maximum 125 L); maximum weight is 20 kg (44 lbs.).
HTML
,
	'category' => 'tips'
),
array(
	'id' => 50,
	'body' => 
<<<HTML
There is no limit to the number of bulky items set out on collection day. These include furniture, mattresses, carpet (1m / 39" lengths, tied in bundles), etc., but do not include non-collectables such as scrap metal, appliances, construction and renovation materials.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 51,
	'body' => 
<<<HTML
A maximum of up to 4 containers per collection is allowed.  The container limit applies to each registered residential unit. For example, a duplex is allowed 8 bags, a triplex is allowed 12 bags, and a multi-unit townhome complex is allowed 4 containers for each unit.
HTML
,
	'category' => 'tips'
),
array(
	'id' => 52,
	'body' => 
<<<HTML
Extra garbage?  There are three depot locations where extra garbage can be taken (fees apply). Information about depot locations and hours can be found at <a href="http://www.london.ca">www.london.ca</a> or by calling 519-661-4585. In addition, there are two collection days per year when the container limit will not be enforced:
<strong>The first collection following Christmas (December 25th)</strong>, and <strong>Spring collection in late April/early May.</strong>
HTML
,
	'category' => 'tips'
	)
);

$this->Content->saveAll($tips);

		}
		return true;
	}
}
?>