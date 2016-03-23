<?php
require_once("config.php");
require_once('codebird/codebird.php');

$ip   = IP;
$port = PORT;

$query          = json_decode(file_get_contents("https://mcapi.ca/query/$ip:$port/mcpe"), true);
$status         = $query["status"];
$version        = $query["version"];
$players_online = number_format($query["players"]["online"]);
$players_max    = number_format($query["players"]["max"]);

if ($status == TRUE) {
    $tweet = TWEET_ONLINE;
} else {
    $tweet = TWEET_OFFLINE;
}

\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
$cb = \Codebird\Codebird::getInstance();
$cb->setToken(ACCESS_TOKEN, ACCESS_SECRET);

$params = array(
    'status' => "$tweet"
);
$reply  = $cb->statuses_update($params);
?>
