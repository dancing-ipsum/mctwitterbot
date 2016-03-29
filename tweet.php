<?php
require_once("config.php");
require_once('codebird/codebird.php');

# Server Info
define("IP", "play.avengetech.net");
define("PORT", "19132");
$ip   = IP;
$port = PORT;

$query          = json_decode(file_get_contents("https://mcapi.ca/query/$ip:$port/mcpe"), true);
$status         = $query["status"];
$version        = $query["version"];
$players_online = number_format($query["players"]["online"]);
$players_max    = number_format($query["players"]["max"]);

# Tweets
define("TWEET_ONLINE", "Players:\n$players_online/$players_max\n\nVersion:\n$version");
define("TWEET_OFFLINE", "Server is offline or unreachable.");
if ($status == TRUE) {
    $tweet = TWEET_ONLINE;
} else {
    $tweet = TWEET_OFFLINE;
}

# Twitter Tokens
define("CONSUMER_KEY", "Claim at apps.twitter.com");
define("CONSUMER_SECRET", "Claim at apps.twitter.com");
define("ACCESS_TOKEN", "Claim at apps.twitter.com");
define("ACCESS_SECRET", "Claim at apps.twitter.com");
\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
$cb = \Codebird\Codebird::getInstance();
$cb->setToken(ACCESS_TOKEN, ACCESS_SECRET);

$params = array(
    'status' => "$tweet"
);
$reply  = $cb->statuses_update($params);
?>
