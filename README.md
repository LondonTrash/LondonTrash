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
* Set up cron for notifications (optional, see below)

## Cron setup (for notifications)

Assuming PHP is in `/usr/bin` and this repo has been cloned to `/path/to/londontrash/app`:

```
/path/to/londontrash/cake/console/cake notification -cli /usr/bin -app /path/to/londontrash/app >> /path/to/londontrash/app/tmp/logs/notifications.log
```
