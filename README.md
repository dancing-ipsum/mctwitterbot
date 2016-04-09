# mctwitterbot
*Please report all bugs via the issue tracker on this repo, and follow [@DALTONTASTIC](https://twitter.com/DALTONTASTIC) on Twitter for development updates.*

## Getting Started
In order to use this script you'll need to create a new Twitter application at [apps.twitter.com](https://apps.twitter.com). Your Twitter application must have Read and Write permissions (luckily that is the default setting don't touch anything). Also be sure to click on "manage keys and access tokens" to create your access token/access token secret. Overall there is four tokens you'll be inputting into this script's configuration.

Inside of config.php be sure to set a password for tweet.php to prevent unauthorized access. For added security it's advised you don't host this script in a publicly accessible directory to begin with. In order to query this script you'll visit **tweet.php?password=yourpassword** and if the password is incorrect it won't tweet.

If you are querying a MCPE server set the mcpe section in config.php to true. If you are querying a PC server set it to false.

*To automate your Twitter account setup a cronjob and make it visit tweet.php?password=yourpassword at the interval you define.*
