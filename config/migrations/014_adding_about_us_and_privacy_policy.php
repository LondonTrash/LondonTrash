<?php
class M4ca2a63cf96843b2b841f2ee3201ca43 extends CakeMigration {

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
		'id' => 53,
		'slug' => 'privacy-policy',
		'title' => "Privacy Policy",
		'body' => 
<<<HTML
<h3>LONDON TRASH PRIVACY POLICY - COMMITMENT TO YOUR PRIVACY</h3>

<p>This site is owned and operated by London Trash. Your privacy on the Internet is of the
utmost importance to us. At London Trash, we want to make your experience online
satisfying and safe.</p>

<p>Because we gather certain types of information about our users, we feel you should fully
understand our policy and the terms and conditions surrounding the capture and use of
that information. This privacy statement discloses what information we gather and how
we use it.</p>

<h3>INFORMATION LONDON TRASH GATHERS AND TRACKS</h3>

<h5>London Trash gathers two types of information about users:</h5>

<ol>
<li><p>Information that users provide through optional, voluntary submissions. These are
voluntary submissions to receive our electronic reminders.</p></li>

<li><p>Information London Trash gathers through aggregated tracking information derived
mainly by tallying page views throughout our sites. This information allows us to better
tailor our content to readers' needs and to better understand the demographics of our
audience. Under no circumstances does London Trash divulge any information about an
individual user to a third party unless required to by law.</p></li>
</ol>

<p>London Trash Gathers User Information In The Following Processes:</p>

<h4>Optional Voluntary Information</h4>

<h5>We offer the following free services, which require some type of voluntary submission of
personal information by users:</h5>

<ol>
<li><strong>Electronic reminders policy</strong>

<p>We offer a free electronic reminders to users. London Trash gathers the email
addresses and/or phone numbers of users who voluntarily subscribe. Users may
remove themselves from this dispatch list by following the instructions provided in every
email or phone reminder that points users to the subscription management page.</p></li>

<li><strong>(Sharing stuff) policy</strong>
<p>Our site users can choose to electronically forward information to someone else by
clicking (sharing stuff). The user must provide their email address, as well as that of
the recipient. This information is used only in the case of transmission errors and, of course, to let the recipient know who sent the information. The email is not used for any
other purpose. </p></li></ol>

<h4>Usage tracking</h4>

<p>London Trash tracks user traffic patterns throughout our site. However, we do not
correlate this information with data about individual users. London Trash does break
down overall usage statistics according to a user's domain name, browser type, and
MIME type by reading this information from the browser string (information contained in
every user's browser).</p>

<p>We use tracking information to determine which areas of our sites users like and don't
like based on traffic to those areas. We do not track what individual users read, but
rather how well each page performs overall. This helps us continue to build a better
service for you.</p>

<h4>Cookies</h4>

<p>We may place a text file called a "cookie" in the browser files of your computer. The
cookie itself does not contain personal information although it will enable us to relate
your use of this site to information that you have specifically and knowingly provided.
But the only personal information a cookie can contain is information you supply
yourself. A cookie can't read data off your hard disk or read cookie files created by other
sites. London Trash uses cookies to remember what is important to you and display
personalized information.</p>

<p>You can refuse cookies by turning them off in your browser. If you've set your browser to
warn you before accepting cookies, you will receive the warning message with each
cookie. You do not need to have cookies turned on to use this site.</p>

<h3>SHARING OF THE INFORMATION</h3>

<p>London Trash uses the above-described information to tailor our content to suit your
needs. We will not share information about individual users with any third party, except
to comply with applicable law or valid legal process or to protect the personal safety of
our users or the public.</p>

<h3>SECURITY</h3>

<p>London Trash operates secure data networks protected by industry standard firewall
and password protection systems. Our security and privacy policies are periodically
reviewed and enhanced as necessary and only authorized individuals have access to
the information provided by our customers.</p>

<h3>OPT-OUT POLICY</h3>
<h5>We give users options wherever necessary and practical. Such choices include:</h5>

<ul><li>Opting not to register to receive our electronic reminders.</li>

<li>Following the opt-out instructions included with every reminder.</li>
</ul>
HTML
,
	'category' => 'pages'
	),
	array(
		'id' => 54,
		'slug' => 'about',
		'title' => "About",
		'body' => 
<<<HTML
<p>This site is a product of a weekend-long project by a team of gifted designers and developers and a bunch of ordinary citizens who believed something amazing was possible. Over the course of two days, 30 strangers formed a team, shared their talents and knowledge, and started a movement. It was our city's very first hackathon &ndash; it won't be our last.</p>


<h2>Team Profile</h2>
<p class="contributor">Shawn Adamsson<br /><a href="http://twitter.com/late2game">@late2game</a></p>
<p class="contributor">Jody Bailey<br /><a href="http://twitter.com/3oh6">@3oh6</a></p>
<p class="contributor">John Blain<br /><a href="http://twitter.com/JohnGBlain">@JohnGBlain</a></p>
<p class="contributor">Gavin Blair<br /><a href="http://twitter.com/gavinblair">@gavinblair</a></p>
<p class="contributor">Zoe Blair<br /><a href="http://twitter.com/zoster">@zoster</a></p>
<p class="contributor">Stuart Clark<br /><a href="http://twitter.com/stuartclark">@stuartclark</a></p>
<p class="contributor">Bill Deys<br /><a href="http://twitter.com/billdeys">@billdeys</a></p>
<p class="contributor">Rachel Fee<br /><a href="http://twitter.com/RachFee">@RachFee</a></p>
<p class="contributor">Stephen Henderson<br /><a href="http://twitter.com/hendersonsk">@hendersonsk</a></p>
<p class="contributor">Peter Janes<br /><a href="http://twitter.com/peterjanes">@peterjanes</a></p>
<p class="contributor">Ryan Johnston<br /></p>         
<p class="contributor">Jared Lerner<br /><a href="http://twitter.com/jrrrrd">@jrrrrd</a></p>
<p class="contributor">John Leschinski<br /><a href="http://twitter.com/Picard102">@Picard102</a></p>
<p class="contributor">Carolyn Marshall<br /><a href="http://twitter.com/Karolijn">@Karolijn</a></p>
<p class="contributor">Aaron McGowan<br /><a href="http://twitter.com/amcgowanca">@amcgowanca</a></p>
<p class="contributor">Wade Pedersen<br /><a href="http://twitter.com/wmpedersen">@wmpedersen</a></p>
<p class="contributor">Trevor Perkins<br /><a href="http://twitter.com/bulltron_ca">@bulltron_ca</a></p>
<p class="contributor">Scott Reeves<br /><a href="http://twitter.com/Cottser">@Cottser</a></p>
<p class="contributor">Greg Smith<br /><a href="http://twitter.com/SomethingOn">@SomethingOn</a></p>
<p class="contributor">Noah Stewart<br /><a href="http://twitter.com/revnoah">@revnoah</a></p>
<p class="contributor">Kevin Van Lierop<br /><a href="http://twitter.com/KVL">@KVL</a></p>
<p class="contributor">James Wilkinson<br /><a href="http://twitter.com/jerw">@jerw</a></p>
<p class="contributor">Brandon Young<br /><a href="http://twitter.com/zE_bEE">@zE_bEE</a></p>

<div class="clear"></div>
<hr>

<div class="org">
<a href="http://www.opendatalondon.ca"><img src="/img/odl-large.png"></a>
A group of citizens advancing the cause of Open Data in London, Ontario. 
</div>


<div class="org">
<a href="http://www.unlondon.ca"><img src="/img/unlondon.png" id="unl"></a>
Our home for the weekend, the unLab, was generously provided by UnLondon. Thank you from our entire team for your support.
</div>
HTML
,
	'category' => 'pages'
	)
);
$this->Content->saveAll($pages);
		}
		return true;
	}
}
?>