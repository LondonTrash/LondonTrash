Setup
==

* Get CakePHP 1.3.4 <http://cakephp.org/>
* Clone this repository into the `/app` folder
* Initialize and clone the git submodules
	* `git submodule init`
	* `git submodule update`
* Add `/cake/console` to your path
* Setup the database information (copy `/app/config/database.php.default` to `/app/config/database.php`)
* For notifications (optional), set up SMTP server details (copy `/app/config/smtp.php.default` to `/app/config/smtp.php`)
* Run the migrations `cake migration all`